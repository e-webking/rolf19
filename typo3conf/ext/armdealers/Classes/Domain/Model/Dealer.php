<?php
namespace ARM\Armdealers\Domain\Model;

/**
 * Dealer
 */
class Dealer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * street
     *
     * @var string
     */
    protected $street = '';

    /**
     * city
     *
     * @var string
     */
    protected $city = '';
    
    /**
     * zip
     *
     * @var string
     */
    protected $zip = '';
    
    /**
     *
     * @var string
     */
    protected $iso2cn = '';

    /**
     * 
     * @var int
     */
    protected $feuser = 0;
    
    /**
     *
     * @var string
     */
    protected $country = '';


    /**
     * phone
     *
     * @var string
     */
    protected $phone = '';
    
    /**
     * email
     *
     * @var string
     */
    protected $email = '';
    
    /**
     *
     * @var int
     */
    protected $dealerpg = 0;
    
    /**
     *
     * @var string
     */
    protected $pgurl = '';
    
    /**
     *
     * @var int
     */
    protected $contactpid;

    /**
     * lat
     *
     * @var double
     */
    protected $lat = 0.000000;
    
    /**
     * lng
     *
     * @var double
     */
    protected $lng = 0.000000;
    
    /**
     *
     * @var string
     */
    protected $dispmsg = '';

    /**
     * zipcodes
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Zipcode>
     * @cascade remove
     */
    protected $zipcodes = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->zipcodes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the date
     *
     * @return \DateTime $pdate
     */
    public function getPdate()
    {
        return $this->pdate;
    }

    /**
     * Sets the date
     *
     * @param \DateTime $date
     * @return void
     */
    public function setPdate(\DateTime $date)
    {
        $this->pdate = $date;
    }

    /**
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the street
     *
     * @param string $street
     * @return void
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }
    
    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }
    
    /**
     * Returns the iso2cn
     *
     * @return string $iso2cn
     */
    public function getIso2cn()
    {
        return $this->iso2cn;
    }

    /**
     * Sets the iso2cn
     *
     * @param string $iso2cn
     * @return void
     */
    public function setIso2cn($iso2cn)
    {
        $this->iso2cn = $iso2cn;
    }
    
    /**
     * Returns the country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     *
     * @param string $country
     * @return void
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }
    
    /**
     * Returns the phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Sets the phone
     *
     * @param string $phone
     * @return void
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }
    
    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Returns the dealerpg
     *
     * @return int $dealerpg
     */
    public function getDealerpg()
    {
        return $this->dealerpg;
    }

    /**
     * Sets the dealerpg
     *
     * @param int $dealerpg
     * @return void
     */
    public function setDealerpg($dealerpg)
    {
        $this->dealerpg = (int)$dealerpg;
    }
    
    /**
     * Returns the pgurl
     *
     * @return string $pgurl
     */
    public function getPgurl()
    {
        return $this->pgurl;
    }

    /**
     * Sets the pgurl
     *
     * @param string $pgurl
     * @return void
     */
    public function setPgurl($pgurl)
    {
        $this->pgurl = $pgurl;
    }

    /**
     * Returns the contactpid
     *
     * @return int $contactpid
     */
    public function getContactpid()
    {
        return $this->contactpid;
    }

    /**
     * Sets the contactpid
     *
     * @param int $contactpid
     * @return void
     */
    public function setContactpid($contactpid)
    {
        $this->contactpid = $contactpid;
    }

    /**
     * Returns the lat
     *
     * @return double $lat
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Sets the lat
     *
     * @param double $lat
     * @return void
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }
    
    /**
     * Returns the lng
     *
     * @return double $lng
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Sets the lng
     *
     * @param double $lng
     * @return void
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }
    
    /**
     * 
     * @param string $dispmsg
     * @return void
     */
    public function setDispmsg($dispmsg)
    {
        $this->dispmsg = $dispmsg;
    }
    
    /**
     * 
     * @return string 
     */
    public function getDispmsg()
    {
        return $this->dispmsg;
    }

    /**
     * Adds a Zipcode
     *
     * @param \ARM\Armdealers\Domain\Model\Zipcode $zipcode
     * @return void
     */
    public function addZipcode(\ARM\Armdealers\Domain\Model\Zipcode $zipcode)
    {
        $this->zipcodes->attach($zipcode);
    }

    /**
     * Removes a Zipcode
     *
     * @param \ARM\Armdealers\Domain\Model\Zipcode $zipcodeToRemove The Zipcode to be removed
     * @return void
     */
    public function removeZipcode(\ARM\Armdealers\Domain\Model\Zipcode $zipcodeToRemove)
    {
        $this->zipcodes->detach($zipcodeToRemove);
    }

    /**
     * Returns the zipcodes
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Zipcode> $zipcodes
     */
    public function getZipcodes()
    {
        return $this->zipcodes;
    }

    /**
     * Sets the zipcodes
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Zipcode> $zipcodes
     * @return void
     */
    public function setZipcodes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $zipcodes)
    {
        $this->zipcodes = $zipcodes;
    }
    
    /**
     * Returns the feuser
     *
     * @return int $feuser
     */
    public function getFeuser()
    {
        return $this->feuser;
    }

    /**
     * Sets the feuser
     *
     * @param int $feuser
     * @return void
     */
    public function setFeuser($feuser)
    {
        $this->feuser = (int)$feuser;
    }
}
