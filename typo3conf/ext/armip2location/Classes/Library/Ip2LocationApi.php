<?php
namespace ARM\Armip2location\Library;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

class Ip2LocationApi {
    
    public $countryCode;
    public $countryName;
    public $regionName;
    public $cityName;
    public $latitude;
    public $longitude;
    public $zipCode;
    public $isp;
    public $domain;
    public $timeZone;
    public $netSpeed;
    public $iddCode;
    public $areaCode;
    public $weatherStationCode;
    public $weatherStationName;
    public $mcc;
    public $mnc;
    public $mobileBrand;
    public $elevation;
    public $usageType;
    protected $apiKey;
    protected $package;
    protected $useSSL;

    /**
     * 
     * @param string $apiKey
     * @param string $package
     * @param bool $useSSL
     */
    public function __construct($apiKey = '', $package = 'WS1', $useSSL = false)
    {
        $this->apiKey = $apiKey;
        $this->package = $package;
        $this->useSSL = $useSSL;
    }

    /**
     * 
     * @param string $ip
     * @return boolean
     */
    public function query($ip)
    {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }
        $response = $this->get('http' . (($this->useSSL) ? 's' : '') . '://api.ip2location.com/v2/?' . http_build_query([
                'key'     => $this->apiKey,
                'ip'      => $ip,
                'package' => $this->package,
                'format'  => 'json',
        ]));

        if (($json = json_decode($response)) === null) {
            return false;
        }

        if (isset($json->response)) {
            return false;
        }

        $this->countryCode = (string) (isset($json->country_code)) ? $json->country_code :'N/A';
        $this->countryName = (string) (isset($json->country_name)) ? $json->country_name :'N/A';
        $this->regionName = (string) (isset($json->region_name)) ? $json->region_name :'N/A';
        $this->cityName = (string) (isset($json->city_name)) ? $json->city_name :'N/A';
        $this->latitude = (float) (isset($json->latitude)) ? $json->latitude :'N/A';
        $this->longitude = (float) (isset($json->longitude)) ? $json->longitude :'N/A';
        $this->zipCode = (string) (isset($json->zip_code)) ? $json->zip_code :'N/A';
        $this->timeZone = (string) (isset($json->time_zone)) ? $json->time_zone :'N/A';
        $this->isp = (string) (isset($json->isp)) ? $json->isp :'N/A';
        $this->domain = (string) (isset($json->domain)) ? $json->domain :'N/A';
        $this->netSpeed = (string) (isset($json->net_speed)) ? $json->net_speed :'N/A';
        $this->iddCode = (string) (isset($json->idd_code)) ? $json->idd_code :'N/A';
        $this->areaCode = (string) (isset($json->area_code)) ? $json->area_code :'N/A';
        $this->weatherStationCode = (string) (isset($json->weather_station_code)) ? $json->weather_station_code :'N/A';
        $this->weatherStationName = (string) (isset($json->weather_station_name)) ? $json->weather_station_name :'N/A';
        $this->mcc = (string) (isset($json->mcc)) ? $json->mcc :'N/A';
        $this->mnc = (string) (isset($json->mnc)) ? $json->mnc :'N/A';
        $this->mobileBrand = (string) (isset($json->mobile_brand)) ? $json->mobile_brand :'N/A';
        $this->elevation = (int) (isset($json->elevation)) ? $json->elevation :'N/A';
        $this->usageType = (string) (isset($json->usage_type)) ? $json->usage_type :'N/A';

        return true;
    }

    /**
     * 
     * @param string $url
     * @return string
     */
    private function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'IP2LocationAPI_PHP-1.0.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $response = curl_exec($ch);

        return $response;
    }
    
    /**
     * 
     * @param string $ip
     */
    public function getFromLocalDb($ip) {
     
        $ipNum = $this->convertIp2Numeric($ip);
        
        $table = 'tx_armip2location_domain_model_ip';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $records = $queryBuilder->select('cn2iso')
                     ->from($table)
                     ->where(
                        $queryBuilder->expr()->lte('ipstart', $ipNum),
                        $queryBuilder->expr()->gte('ipend', $ipNum)
                    )
                    ->execute()
                    ->fetchAll();
        if (count($records) > 0) {
            return $records[0]['cn2iso'];
        }
        
        return false;
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
