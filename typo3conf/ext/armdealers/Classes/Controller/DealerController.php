<?php
namespace ARM\Armdealers\Controller;

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

/**
 * DealerController
 */
class DealerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * dealerRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\DealerRepository
     * @inject
     */
    protected $dealerRepository = null;
    
    /**
     * zipcodeRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\ZipcodeRepository
     * @inject
     */
    protected $zipcodeRepository = null;
    

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        if ($this->settings['single'] && isset($this->settings['dealer'])) {
            $dealer = $this->dealerRepository->findByUid($this->settings['dealer']);
            $jsDealers = 'var dealers=[';
            $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",dvinfo:'del".$dealer->getUid()."'}";
            $jsDealers .= "];";
            $this->view->assign('dealer', $dealer);
            
        } else {
            $dealers = $this->dealerRepository->findAll();

            $jsDealers = 'var dealers=[';
            foreach ($dealers as $dealer) {
                $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",dvinfo:'del".$dealer->getUid()."'},";
            }
            $jsDealers = substr($jsDealers, 0, -1);
            $jsDealers .= "];";
            $this->view->assign('dealers', $dealers);
        }
        $this->view->assign('jsDealers', $jsDealers);        
    }
    
    /**
     * action list
     *
     * @return void
     */
    public function maplinkAction()
    {
        if ($this->settings['single'] && isset($this->settings['dealer'])) {
            $dealer = $this->dealerRepository->findByUid($this->settings['dealer']);
            $jsDealers = 'var dealers=[';
            $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",url:'".$dealer->getPgurl()."'}";
            $jsDealers .= "];";
            $this->view->assign('dealer', $dealer);
            
        } else {
            $dealers = $this->dealerRepository->findAll();

            $jsDealers = 'var dealers=[';
            foreach ($dealers as $dealer) {
                $jsDealers .= "{uid:".$dealer->getUid().",lat:".$dealer->getLat().",lng:".$dealer->getLng().",url:'".$dealer->getPgurl()."'},";
            }
            $jsDealers = substr($jsDealers, 0, -1);
            $jsDealers .= "];";
            $this->view->assign('dealers', $dealers);
        }
        $this->view->assign('jsDealers', $jsDealers);        
    }

    /**
     * action form
     *
     * @return void
     */
    public function formAction()
    {
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
            $dealer = $zips[0]->getDealer();
            
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
}
