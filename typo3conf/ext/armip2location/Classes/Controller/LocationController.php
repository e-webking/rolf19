<?php
namespace ARM\Armip2location\Controller;

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
 * LocationController
 */
class LocationController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var array
     */
    protected $zurichRegion = ['Aargau','Basel-Landschaft','Basel-Stadt','Bern','Schaffhausen','Solothurn','Valais','Zug','Zurich'];
    
    /**
     * @var array
     */
    protected $rapperswilRegion = ['Appenzell Ausserrhoden','Appenzell Innerrhoden','Glarus','Graubunden','Nidwalden','Obwalden','Sankt Gallen','Schwyz','Thurgau','Ticino','Uri'];
    
    /**
     *
     * @var \ARM\Armip2location\Domain\Repository\IpRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $ipRepository;
    
    /**
     * 
     * @var \ARM\Armip2location\Domain\Repository\IpzuerichrapperswilRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $zuerichRapperswillRepository;


    /**
     * 
     */
    public function switcherAction() {
        
        $useLocal = $this->settings['useLocal'];
        $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
        if ($useLocal == "1") {
            $this->localDb($usrIp);
        } else {
            $this->onlineApi($usrIp);
        }
    }
    
    
    /**
     * Redirect to Zuerich
     */
    public function toZuerichAction() {
        
        $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
        $ipNum = $this->convertIp2Numeric($usrIp);
        
        $results = $this->zuerichRapperswillRepository->getRecord($ipNum);
        $redirect = false;
        if (count($results) > 0) {
            foreach($results as $rec) {
                if ($rec instanceof \ARM\Armip2location\Domain\Model\Ipzuerichrapperswil) {
                    $region = $rec->getRegion();
                    if (in_array($region, $this->zurichRegion)) {
                        $redirect = true;
                        break;
                    }
                }
            }
        }
        
        if ($redirect) {
            $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
            $this->redirectToUri($link);
        }
        die();
    }
    
    /**
     * Redirect to Rapperswil
     */
    public function toRapperswilAction() {
        
        $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
        $ipNum = $this->convertIp2Numeric($usrIp);
        
        $results = $this->zuerichRapperswillRepository->getRecord($ipNum);
        $redirect = false;
        if (count($results) > 0) {
            foreach($results as $rec) {
                if ($rec instanceof \ARM\Armip2location\Domain\Model\Ipzuerichrapperswil) {
                    $region = $rec->getRegion();
                    if (in_array($region, $this->rapperswilRegion)) {
                        $redirect = true;
                        break;
                    }
                }
            }
        }
        
        if ($redirect) {
            $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
            $this->redirectToUri($link);
        }
        die();
    }
    
    /**
     * 
     * @param string $ip
     */
    protected function localDb($ip) {
        
        $ipNum = $this->convertIp2Numeric($ip);
        
        if ($this->settings['debug'] == 1) {
            echo "<br>Converted IPNum: ". $ipNum. " for $ip";
        }
        if ($this->settings['region']) {
            
            $results = $this->zuerichRapperswillRepository->getRecord($ipNum);
            
            $redirectRap = false;
            $redirectZur = false;
            if (count($results) > 0) {
                foreach($results as $rec) {
                    if ($rec instanceof \ARM\Armip2location\Domain\Model\Ipzuerichrapperswil) {
                        $region = $rec->getRegion();
                        if (in_array($region, $this->rapperswilRegion)) {
                            $redirectRap = true;
                            break;
                        }
                        if (in_array($region, $this->zurichRegion)) {
                            $redirectZur = true;
                            break;
                        }
                    }
                }
                if ($redirectZur) {
                    $link = $this->uriBuilder->setTargetPageUid($this->settings['zuerich'])->build();
                    $this->redirectToUri($link);
                    die();
                }
                if ($redirectRap) {
                    $link = $this->uriBuilder->setTargetPageUid($this->settings['rapperswil'])->build();
                    $this->redirectToUri($link);
                    die();
                }
            } 
        }
        //Check DB
        $dbRec = $this->ipRepository->getRecord($ipNum);
        $setCountry = $this->settings['country'];
        
        $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
        
        if ($dbRec instanceof \ARM\Armip2location\Domain\Model\Ip && !is_null($dbRec)) {
            
            $cn2code = $dbRec->getCn2iso();
            
            // echo 'Debug:'.$cn2code . 'set country: '.$setCountry;
            // echo "Page to go: ".$link;
            // exit;
//            if ($cn2code == 'DE') {
//                header("location: /visit.html");
//                exit;
//            }
            if (isset($setCountry) && isset($cn2code)) {
                if ($setCountry == 'AT') {
                    if ($cn2code != 'AT') {
                        //redirect
                        if ($link != "/") {
                            $this->redirectToUri($link);
                        }
                    }
                } else {
                    if ($cn2code == 'AT') {
                        //redirect
                        if ($link != "/") {
                                $this->redirectToUri($link);
                        }
                    }
                }
            }
        }
    }
    
    /**
     * 
     * @param string $ip
     * @return int
     */
    protected function convertIp2Numeric($ip) {
        //echo $ip;
        if ($ip == "") {
            return 0;
	} else {
            $ips = explode(".", $ip);
            //var_dump($ips);
            
            return ($ips[3] + ($ips[2] * 256) + ($ips[1] * 256 * 256) + ($ips[0] * 256 * 256 * 256));
	}
    }
    
    /**
     * 
     * @param string $usrIp
     */
    protected function onlineApi($usrIp) {
        
        $apiKey = $this->settings['apiKey'];
        $mode = $this->settings['mode'];
        $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
        
        $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
        $apiObj->query($usrIp);
        
        if ($apiObj->countryCode == 'DE') {
            header("location: /visit.html");
            exit;
        }
        
        $setCountry = $this->settings['country'];
        
        if ($setCountry == 'AT') {
            if ($apiObj->countryCode != 'AT') {
                //redirect
		$this->redirectToUri($link);
            }
        } else {
            if ($apiObj->countryCode == 'AT') {
               //redirect
                $this->redirectToUri($link);
            }
        }
    }

    /**
     * 
     */
    public function visitComAction() {
        
        $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
        $this->localDb($usrIp);
        /*$apiKey = $this->settings['apiKey'];
        $mode = $this->settings['mode'];
        $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
        $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
        var_dump($apiObj);
        
        $apiObj->query($usrIp);
        
        if ($apiObj->countryCode == 'DE') {
            header("location: /visit.html");
            exit;
        }
        */
    }
}