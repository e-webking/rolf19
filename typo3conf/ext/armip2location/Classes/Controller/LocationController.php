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
     *
     * @var \ARM\Armip2location\Domain\Repository\IpRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $ipRepository;
    
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
     * 
     * @param string $ip
     */
    protected function localDb($ip) {
        
        $ipNum = $this->convertIp2Numeric($ip);
        
       // echo "<br>Converted IPNum: ". $ipNum;
        //Check DB
        $dbRec = $this->ipRepository->getRecord($ipNum);
        $setCountry = $this->settings['country'];
        $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
        
        if ($dbRec instanceof \ARM\Armip2location\Domain\Model\Ip && !is_null($dbRec)) {
            
            $cn2code = $dbRec->getCn2iso();
            
           // echo 'Debug:'.$cn2code . 'set country: '.$setCountry;

            if ($cn2code == 'DE') {
                header("location: /visit.html");
                exit;
            }
            if ($setCountry == 'AT') {
                if ($cn2code != 'AT') {
                    //redirect
                    $this->redirectToUri($link);
                }
            } else {
                if ($cn2code == 'AT') {
                   //redirect
                    $this->redirectToUri($link);
                }
            }
        } else {
            echo "Strange: No record!";
        }
    }
    
    /**
     * 
     * @param string $ip
     * @return int
     */
    protected function convertIp2Numeric($ip) {
        
        if ($ip == "") {
            return 0;
	} else {
            $ips = explode(".", $ip);
            return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
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
        $apiKey = $this->settings['apiKey'];
        $mode = $this->settings['mode'];
        $link = $this->uriBuilder->setTargetPageUid($this->settings['page'])->build();
        $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
        //var_dump($apiObj);
        
        $apiObj->query($usrIp);
        if ($apiObj->countryCode == 'DE') {
            header("location: /visit.html");
            exit;
        }
    }
}