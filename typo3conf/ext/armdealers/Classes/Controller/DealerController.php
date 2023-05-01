<?php
namespace ARM\Armdealers\Controller;

if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('armip2location')) {
    require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('armip2location').'Classes/Library/Ip2LocationApi.php');
}

/***
 *
 * This file is part of the "ARM Dealers" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019
 *
 ***/
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * DealerController
 */
class DealerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * dealerRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\DealerRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $dealerRepository;
    
    /**
     * zipcodeRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\ZipcodeRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $zipcodeRepository;
    

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $slat = $this->settings['lat'];
        $slng = $this->settings['lng'];
        
        if ($this->settings['single'] && isset($this->settings['dealer'])) {
            $dealer = $this->dealerRepository->findByUid($this->settings['dealer']);
            $jsDealers = 'var dealers=[';
            $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",dvinfo:'del".$dealer->getUid()."',title:'".$dealer->getTitle()."'}";
            $jsDealers .= "];";
            $this->view->assign('dealer', $dealer);
            
        } else {
            
            if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('armip2location')) {
                 
                $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
                $settingsIp = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Armip2location');
                $apiKey = $settingsIp['apiKey'];
                $mode = $settingsIp['mode'];
                $useLocal = $settingsIp['useLocal'];
                
                if ($useLocal == 1) {
                    
                    $locObj = new \ARM\Armip2location\Library\Ip2LocationApi();
                    if ($cnCode = $locObj->getFromLocalDb($usrIp)) {
                        if ($cnCode == 'AT') {
                            $dealers = $this->dealerRepository->findByIso2cn('AT');
                            $slat = $this->settings['alat'];
                            $slng = $this->settings['alng'];
                        } else {
                            $dealers = $this->dealerRepository->getNotIso2cn('AT');
                        }
                    } else {
                        $dealers = $this->dealerRepository->getNotIso2cn('AT');
                    }
                } else {
                    $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
                    $apiObj->query($usrIp);

                    if ($apiObj->countryCode == 'AT') {
                        $dealers = $this->dealerRepository->findByIso2cn('AT');
                        $slat = $this->settings['alat'];
                        $slng = $this->settings['alng'];
                    } else {
                        $dealers = $this->dealerRepository->getNotIso2cn('AT');
                    }
                }     
            } else {
                $dealers = $this->dealerRepository->getNotIso2cn('AT');
            }
            
            $jsDealers = 'var dealers=[';
            foreach ($dealers as $dealer) {
                if ($dealer instanceof \ARM\Armdealers\Domain\Model\Dealer) {
                    $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",dvinfo:'del".$dealer->getUid()."',title:'".$dealer->getTitle()."'},";
                }
            }
            $jsDealers = substr($jsDealers, 0, -1);
            $jsDealers .= "];";
            $this->view->assign('dealers', $dealers);
        }
        $this->view->assign('slat', $slat);
        $this->view->assign('slng', $slng);
        $this->view->assign('jsDealers', $jsDealers);        
    }
    
    /**
     * action list
     *
     * @return void
     */
    public function maplinkAction()
    {
        $slat = $this->settings['lat'];
        $slng = $this->settings['lng'];
                            
        if ($this->settings['single'] && isset($this->settings['dealer'])) {
            
            $dealer = $this->dealerRepository->findByUid($this->settings['dealer']);
            $jsDealers = 'var dealers=[';
            $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",url:'".$dealer->getPgurl()."',title:'".$dealer->getTitle()."'}";
            $jsDealers .= "];";
            
            $this->view->assign('dealer', $dealer);
            
        } else {
            
            if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('armip2location')) {
                 
                $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
                $settingsIp = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Armip2location');
                $apiKey = $settingsIp['apiKey'];
                $mode = $settingsIp['mode'];
                $useLocal = $settingsIp['useLocal'];
                
                if ($useLocal == 1) {
                    
                    $locObj = new \ARM\Armip2location\Library\Ip2LocationApi();
                    
                    if ($cnCode = $locObj->getFromLocalDb($usrIp)) {
                        
                        if ($cnCode == 'AT') {
                            $dealers = $this->dealerRepository->findByIso2cn('AT');
                            $slat = $this->settings['alat'];
                            $slng = $this->settings['alng'];
                        } else {
                            $dealers = $this->dealerRepository->getNotIso2cn('AT');
                        }
                        
                    } else {
                        $dealers = $this->dealerRepository->getNotIso2cn('AT');
                    }
                } else {
                    $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
                    $apiObj->query($usrIp);

                    if ($apiObj->countryCode == 'AT') {
                        $dealers = $this->dealerRepository->findByIso2cn('AT');
                        $slat = $this->settings['alat'];
                        $slng = $this->settings['alng'];
                    } else {
                        $dealers = $this->dealerRepository->getNotIso2cn('AT');
                    }
                }
            } else {
                $dealers = $this->dealerRepository->getNotIso2cn('AT');
            }

            $jsDealers = 'var dealers=[';
            
            foreach ($dealers as $dealer) {
                $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",url:'".$dealer->getPgurl()."',title:'".$dealer->getTitle()."'},";
            }
            
            $jsDealers = substr($jsDealers, 0, -1);
            $jsDealers .= "];";

            $this->view->assign('dealers', $dealers);
        }
        $this->view->assign('slat', $slat);
        $this->view->assign('slng', $slng);
        $this->view->assign('jsDealers', $jsDealers);        
    }

    /**
     * action form
     *
     * @return void
     */
    public function formAction()
    {
        if (\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('armip2location')) {
                 
            $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
            $settingsIp = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Armip2location');
            $apiKey = $settingsIp['apiKey'];
            $mode = $settingsIp['mode'];
            $useLocal = $settingsIp['useLocal'];
                
            if ($useLocal == 1) {
                $locObj = new \ARM\Armip2location\Library\Ip2LocationApi();
                if ($cnCode = $locObj->getFromLocalDb($usrIp)) {
                    $ip2loc = ($cnCode == 'CH')?'CHE':'AUT';
                } else {
                    $ip2loc = 'AUT';
                }
            } else {
                $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
                $apiObj->query($usrIp);
                $ip2loc = ($apiObj->countryCode == 'CH')?'CHE':'AUT';
            }
            $this->view->assign('ip2loc',$ip2loc);
        }
        if ($this->request->hasArgument('vorname')) {
            $vorname = $this->request->getArgument('vorname');
            $this->view->assign('vorname', $vorname);
        }
        if ($this->request->hasArgument('name')) {
            $name = $this->request->getArgument('name');
            $this->view->assign('name', $name);
        }
        if ($this->request->hasArgument('zip')) {
            $zip = $this->request->getArgument('zip');
            $this->view->assign('zip', $zip);
        }
        if ($this->request->hasArgument('country')) {
            $country = $this->request->getArgument('country');
            $this->view->assign('country', $country);
        }
        if ($this->request->hasArgument('email')) {
            $email = $this->request->getArgument('email');
            $this->view->assign('email', $email);
        }
        if ($this->request->hasArgument('message')) {
            $message = $this->request->getArgument('message');
            $this->view->assign('message', $message);
        }
    }
    
    
    public function thankyouAction() {
        
        if ($this->request->hasArgument('vorname')) {
            $vorname = $this->request->getArgument('vorname');
            $data['vorname'] = $vorname;
        }
        if ($this->request->hasArgument('name')) {
            $name = $this->request->getArgument('name');
            $data['name'] = $name;
        }
        if ($this->request->hasArgument('zip')) {
            $zip = $this->request->getArgument('zip');
            $data['zip'] = $zip;
        }
        if ($this->request->hasArgument('country')) {
            $country = $this->request->getArgument('country');
            $data['country'] = $country;
        }
        if ($this->request->hasArgument('email')) {
            $email = $this->request->getArgument('email');
            $data['email'] = $email;
        }
        if ($this->request->hasArgument('message')) {
            $message = $this->request->getArgument('message');
            $data['message'] = $message;
        }
        
        $sendEmail = true;
        
        if ($vorname == '') {
            $sendEmail = FALSE;
            $this->addFlashMessage(LocalizationUtility::translate("tx_armdealers_domain_model_err.vorname", "armdealers"),'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        if ($name == '') {
             $sendEmail = FALSE;
            $this->addFlashMessage(LocalizationUtility::translate("tx_armdealers_domain_model_err.name", "armdealers"),'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        if ($zip == '') {
            $sendEmail = FALSE;
            $this->addFlashMessage(LocalizationUtility::translate("tx_armdealers_domain_model_err.zip", "armdealers"),'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        if ($email == '') {
            $sendEmail = FALSE;
            $this->addFlashMessage(LocalizationUtility::translate("tx_armdealers_domain_model_err.email", "armdealers"),'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        if ($message == '') {
            $sendEmail = FALSE;
            $this->addFlashMessage(LocalizationUtility::translate("tx_armdealers_domain_model_err.message", "armdealers"),'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        
        if (!$sendEmail) {
            $this->forward('form');
        } else {
            //get the dealer
            $zips = $this->zipcodeRepository->getByZipCountry($zip,$country);
            if ($zips[0] instanceof \ARM\Armdealers\Domain\Model\Zipcode) {
                $dealer = $zips[0]->getDealer();
            }
            if ($dealer instanceof \ARM\Armdealers\Domain\Model\Dealer) {
                $this->sendEmail($dealer->getTitle(), $dealer->getEmail(), $data);
            }
            if (isset($this->settings['thanku'])) {
                $link = $this->uriBuilder->setTargetPageUid($this->settings['thanku'])->build();
		$this->redirectToUri($link);
            }   
        }
    }
    
    /**
     * @param array $data
     */
    protected function sendEmail($name, $email, $data) {
        
        // $email = 'anisur.mullick@gmail.com'; //overriding dealer email
        $subject =  $this->settings['formSubject'];
        $template = 'Kontakt';
        $cc['email']= $data['email'];
        $cc['name'] = $data['vorname'].' '.$data['name'];
        
        
        $mailtpl = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $mailtpl->setFormat('html');

        //$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        //$templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPaths'][0]);
        $templateRootPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::siteRelPath('armdealers') . 'Resources/Private/Templates/';
        $templatePathAndFilename = $templateRootPath. "Email/{$template}.html";
        $mailtpl->setTemplatePathAndFilename($templatePathAndFilename);
        $mailtpl->assign('data', $data);
        $mailbody = $mailtpl->render();

        try {
            $objMail = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');

            // mail to User
            $senderMail = $this->settings['sysEmail'];
            $senderName = $this->settings['sysName'];

            if (GeneralUtility::validEmail($email)) {

                $objMail->setFrom(array($senderMail => $senderName))
                ->setTo(array($email => $name))
                ->setReplyTo(array($cc['email'] => $cc['name']))
                ->setSubject($subject)
                ->setBody($mailbody, 'text/html');

                $objMail->setCc(array($cc['email'] => $cc['name']));
                $objMail->send();

            } 
        } catch (Exception $e){}
        
    }

    /**
     * action minilist
     *
     * @return void
     */
    public function minilistAction()
    {
        $limit = $this->settings['limit'];
        $hideimg = $this->settings['hideimg'];
        if (is_null($limit)) {
            $limit = 3;
        } else {
            $limit = intval($limit);
        }
        $dealers = $this->dealerRepository->findRecent($limit);
        $this->view->assign('hideimg', $hideimg);
        $this->view->assign('dealers', $dealers);
    }

    /**
     * action recent
     *
     * @return void
     */
    public function recentAction()
    {
        $dealers = $this->dealerRepository->findRecent();
        $this->view->assign('dealers', $dealers);
    }
    
    /**
     * List tags
     */
    public function taglistAction() {
        $tags = $this->tagRepository->findAll();
        $this->view->assign('tags', $tags);
    }
    
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function dlrmsgAction(\Psr\Http\Message\ServerRequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response) {
        
        $params = $request->getParsedBody();
        $zip = $params['arguments']['zip'];
        
        try {
            $foreign = 'tx_armdealers_domain_model_dealer';
            $local = 'tx_armdealers_domain_model_zipcode';

            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($foreign);
            $queryBuilder->getRestrictions()->removeAll();

            $expr = $queryBuilder->expr();
            $andCond = $queryBuilder->expr()->andx();
            $andCond->add($expr->eq('foreign.deleted', 0));
            $andCond->add($expr->eq('foreign.hidden', 0));
            $andCond->add($expr->eq('local.deleted', 0));
            $andCond->add($expr->eq('local.hidden', 0));
            $andCond->add($expr->eq('local.zipcode',  $zip));

            $qbReady = $queryBuilder->select('foreign.dispmsg')
                         ->from($foreign, 'foreign')
                         ->innerJoin('foreign', $local, 'local', $expr->eq('foreign.uid','local.dealer'))
                         ->andWhere($andCond);

            $rows = $qbReady->execute()->fetchAll();

            if (count($rows) > 0) {
                $arr['msg'] = $rows[0]['dispmsg'];
            }  
            
            $arr['status'] = 'OK';
            
        } catch (\Exception $e) {
            $arr['status'] = 'ERR';
            $arr['error'] = $e->getMessage();
        }
        
        $json = \ARM\Armdealers\Utility\JsonUtility::array2Json($arr);

        $response->getBody()->write($json);
        $response->withHeader('Content-Type', 'application/json;charset=utf-8');
        
        return $response;
    }
}
