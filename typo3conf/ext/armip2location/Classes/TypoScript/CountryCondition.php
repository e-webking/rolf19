<?php
namespace ARM\Armip2location\TypoScript;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\TypoScript\ConditionMatching\AbstractCondition;
use TYPO3\CMS\Core\Database\ConnectionPool;

class CountryCondition extends AbstractCondition {
    
    /**
     *
     * @var string
     */
    protected $table = 'tx_armip2location_domain_model_ip';
    
    /**
     * 
     * @param array $conditionParameters
     */
    public function matchCondition(array $conditionParameters)
    {

        $useLocal = 0;
        $country = $conditionParameters[0];
        $usrIp = GeneralUtility::getIndpEnv('REMOTE_ADDR');
        
        if (count($conditionParameters) > 1) {
            $useLocal = $conditionParameters[1];
        }
        
        if ($useLocal == 1) {
            
            $ipNum = $this->convertIp2Numeric($usrIp);

            if ($ipNum > 0) {

                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
                $queryBuilder->getRestrictions()->removeAll();
                $expr = $queryBuilder->expr();

                $rec = $queryBuilder->select('cn2iso')
                        ->from($this->table)
                        ->where(
                            $expr->eq('deleted', 0),
                            $expr->eq('hidden', 0),
                            $expr->lte('ipstart',$ipNum),
                            $expr->gte('ipend', $ipNum)
                        )->execute()->fetchAll();

                if (count($rec) > 0) {

                    if ($rec[0]['cn2iso'] == $country) {
                        return true;
                    }
                }
            }
            return false;
            
        } else {
            
            $apiKey = 'FUCTT7BAP7';
            $mode = 'WS1';
            $apiObj = new \ARM\Armip2location\Library\Ip2LocationApi($apiKey, $mode, TRUE);
            $apiObj->query($usrIp);

            if ($country == $apiObj->countryCode) {
                return true;
            }
            return false; 
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
}
