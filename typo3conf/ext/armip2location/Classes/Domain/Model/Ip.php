<?php
namespace ARM\Armdealers\Domain\Model;

/**
 * Zipcode
 */
class Zipcode extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * country
     *
     * @var string
     */
    protected $country = '';
    
    /**
     * city
     *
     * @var string
     */
    protected $city = '';
   
    /**
     * canton
     *
     * @var string
     */
    protected $canton = '';

    /**
     * zipcode
     *
     * @var int
     */
    protected $zipcode = 0;

    /**
     * dealer
     *
     * @var \ARM\Armdealers\Domain\Model\Dealer
     */
    protected $dealer = null;
    
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
     * Returns the canton
     *
     * @return string $canton
     */
    public function getCanton()
    {
        return $this->canton;
    }

    /**
     * Sets the canton
     *
     * @param string $canton
     * @return void
     */
    public function setCanton($canton)
    {
        $this->canton = $canton;
    }

    /**
     * Returns the zipcode
     *
     * @return int $zipcode
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Sets the zipcode
     *
     * @param int $zipcode
     * @return void
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * Returns the dealer
     *
     * @return \ARM\Armdealers\Domain\Model\Dealer $dealer
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Sets the dealer
     *
     * @param \ARM\Armdealers\Domain\Model\Dealer $dealer
     * @return void
     */
    public function setDealer(\ARM\Armdealers\Domain\Model\Dealer $dealer)
    {
        $this->dealer = $dealer;
    }

}
