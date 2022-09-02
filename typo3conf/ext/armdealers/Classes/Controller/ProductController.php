<?php
namespace ARM\Armdealers\Controller;

/***
 *
 * This file is part of the "ARM Dealers" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2022
 *
 ***/
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;
use \TYPO3\CMS\Core\Page\PageRenderer;

/**
 * ProductController
 */
class ProductController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * categoryRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\CategoryRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $categoryRepository;
    
    /**
     * productRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\ProductRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $productRepository;
    
    /**
     * pdealerRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\ProductdealerRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $pdealerRepository;
    
    /**
     * dealerRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\DealerRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $dealerRepository;
    
    /**
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $pageRenderer;

    /**
     * action list
     *
     * @return void
     */
    public function categoryAction()
    {
        $categories = $this->categoryRepository->findAll();
        $this->view->assign('categories', $categories);  
        $dealer = $this->settings['dealer'];
        $dealerObj = $this->dealerRepository->findByUid($dealer);
        $this->view->assign('dealer', $dealerObj);
    }
    
    /**
     * Group action
     */
    public function groupAction() {
        
        $dealer = filter_input(INPUT_GET, "dealer", FILTER_SANITIZE_SPECIAL_CHARS);
        if (intval($dealer) > 0) {
            $category = $this->settings['category'];
            $dealerObj = $this->dealerRepository->findByUid($dealer);
            $catTitle = $this->getCatTitle($category);
            if ($category > 0) {
                $products = $this->productRepository->findByCategory($category);
                $dProducts = [];
                if (count($products)> 0) {
                    foreach($products as $product) {
                        if($this->checkDealerProduct($dealer, $product->getUid())) {
                            $dProducts[] = $product;
                        }
                    }
                }
                $this->view->assign('products', $dProducts);
                $this->view->assign('dealer', $dealerObj);
                $this->view->assign('cattitle', $catTitle);
            } else {
                die('ERROR: Product group not configured!');
            }
        } else {
            die('ERROR: Dealer information not available!');
        }
        
    }
    
    /**
     * Product show action
     */
    public function showAction() {
        
        $slickCss = GeneralUtility::getIndpEnv('TYPO3_SITE_PATH') . 'typo3conf/ext/armdealers/Resources/Public/Css/slick.css';
        $this->pageRenderer->addCssFile($slickCss);
        $slick = GeneralUtility::getIndpEnv('TYPO3_SITE_PATH') . 'typo3conf/ext/armdealers/Resources/Public/Js/slick.js';
        $js = GeneralUtility::getIndpEnv('TYPO3_SITE_PATH') . 'typo3conf/ext/armdealers/Resources/Public/Js/product_slider.js';
        $this->pageRenderer->addJsFooterFile($slick, 'text/javascript', false);
        $this->pageRenderer->addJsFooterFile($js, 'text/javascript', false);
        $dealer = filter_input(INPUT_GET, "dealer", FILTER_SANITIZE_SPECIAL_CHARS);
        $product = filter_input(INPUT_GET, "product", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (($dealer > 0) && ($product > 0)) {
            
            $productdealer = $this->pdealerRepository->getDealerProduct($dealer, $product);
            
            if ($productdealer instanceof \ARM\Armdealers\Domain\Model\Productdealer) {
                
                $this->view->assign('productdealer', $productdealer);
                $this->pageRenderer->setTitle($productdealer->getDealer()->getTitle().': '.$productdealer->getProduct()->getTitle());
                $this->pageRenderer->setMetaTag('name','abstract', $productdealer->getProduct()->getMtitle(),[],true);
                $this->pageRenderer->setMetaTag('name','description', $productdealer->getProduct()->getMdescription(),[],true);
            } else {
                
                $transProduct = $this->getProduct($product);
                $productdealer = $this->pdealerRepository->getDealerProduct($dealer, $transProduct);
                
                if ($productdealer instanceof \ARM\Armdealers\Domain\Model\Productdealer) {
                
                    $this->view->assign('productdealer', $productdealer);
                    $this->pageRenderer->setTitle($productdealer->getDealer()->getTitle().': '.$productdealer->getProduct()->getTitle());
                    $this->pageRenderer->setMetaTag('name','abstract', $productdealer->getProduct()->getMtitle(),[],true);
                    $this->pageRenderer->setMetaTag('name','description', $productdealer->getProduct()->getMdescription(),[],true);
                }
            }
            
        } else {
            die('All information not available');
        }
    }
    
    protected function getProduct($uid) {
        $table = 'tx_armdealers_domain_model_product';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()->removeAll();
        $expr = $queryBuilder->expr();
        if ($GLOBALS['TSFE']->sys_language_uid == 0) {
            $rec = $queryBuilder->select('l10n_parent')
                    ->from($table)
                    ->where(
                        $expr->eq('deleted', 0),
                        $expr->eq('uid', $uid)
                    )
                    ->execute()->fetchAll();
             return $rec[0]['l10n_parent'];
        } else {
             $rec = $queryBuilder->select('uid')
                    ->from($table)
                    ->where(
                        $expr->eq('deleted', 0),
                        $expr->eq('l10n_parent', $uid)
                    )
                    ->execute()->fetchAll();
            return $rec[0]['uid'];
        }
    }

    /**
     * 
     * @param int $category
     * @return string
     */
    protected function getCatTitle($category) {
        
        $table = 'tx_armdealers_domain_model_category';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()->removeAll();
        $expr = $queryBuilder->expr();

        $rec = $queryBuilder->select('title')
                    ->from($table)
                    ->where(
                        $expr->eq('deleted', 0),
                        $expr->eq('uid', $category)
                    )
                    ->execute()->fetchAll();
        return $rec[0]['title'];
    }
    
    /**
     * 
     * @param int $dealer
     * @param int $product
     * @return int
     */
    protected function checkDealerProduct($dealer,$product) {
        
        $table = 'tx_armdealers_domain_model_productdealer';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()->removeAll();
        $expr = $queryBuilder->expr();

        $rec = $queryBuilder->count('*')
                    ->from($table)
                    ->where(
                        $expr->eq('deleted', 0),
                        $expr->eq('hidden', 0),
                        $expr->eq('inshowroom', 1),
                        $expr->eq('dealer', $dealer),
                        $expr->eq('product', $product)
                    )
                    ->execute()->fetchColumn(0);
        return $rec;
    }
    
    /**
     *  Dealer product list
     */
    public function dashboardAction() {
        
        $feuser = $GLOBALS["TSFE"]->fe_user->user['uid'];

        if (intval($feuser) > 0) {
            //get the dealer
            $dealer = $this->dealerRepository->getByFeuser(intval($feuser));
            if ($dealer instanceof \ARM\Armdealers\Domain\Model\Dealer) {
                $dealerUid = $dealer->getUid();
                $products = $this->pdealerRepository->findByDealer($dealerUid);
                $this->view->assign('dealer', $dealer);
                $this->view->assign('products', $products);
            } else {
                die ('Associated dealer cannot be located!');
            }
        } else {
            die ('Authentication failure!');
        }
    }
    
    /**
     * update dealer products
     */
    public function updateAction() {
        
        if ($this->request->hasArgument("pduid")) {
            $pdUidArr = $this->request->getArgument("pduid");
            
            $table = 'tx_armdealers_domain_model_productdealer';
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
            $queryBuilder->getRestrictions()->removeAll();
        
            foreach($pdUidArr as $pduid) {
                
                $splPrice = (int)$_POST['tx_armdealers_dashboard']['splprice']["$pduid"];
                $inShowroom = (int)$_POST['tx_armdealers_dashboard']['inshowroom']["$pduid"];
                $queryBuilder->update($table)
                    ->where($queryBuilder->expr()->eq('uid', $pduid))
                    ->set('splprice', $splPrice)
                    ->set('inshowroom', $inShowroom)
                    ->execute();
              
            }
            
            $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
        }
        $this->redirect('dashboard');
    }
}
