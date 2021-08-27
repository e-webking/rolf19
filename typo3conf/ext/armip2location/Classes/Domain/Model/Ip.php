<?php
namespace ARM\Armip2location\Domain\Model;

/**
 * IP
 */
class Ip extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * country
     *
     * @var string
     */
    protected $country = '';
    
    /**
     * cn2iso
     *
     * @var string
     */
    protected $cn2iso = '';
   
    /**
     * ipend
     *
     * @var int
     */
    protected $ipend = 0;

    /**
     * ipstart
     *
     * @var int
     */
    protected $ipstart = 0;
    
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
     * Returns the cn2iso
     *
     * @return string $cn2iso
     */
    public function getCn2iso()
    {
        return $this->cn2iso;
    }

    /**
     * Sets the cn2iso
     *
     * @param string $cn2iso
     * @return void
     */
    public function setCn2iso($cn2iso)
    {
        $this->cn2iso = $cn2iso;
    }

    /**
     * Returns the ipend
     *
     * @return int $ipend
     */
    public function getIpend()
    {
        return $this->ipend;
    }

    /**
     * Sets the ipend
     *
     * @param int $ipend
     * @return void
     */
    public function setIpend($ipend)
    {
        $this->ipend = $ipend;
    }

    /**
     * Returns the ipstart
     *
     * @return int $ipstart
     */
    public function getIpstart()
    {
        return $this->ipstart;
    }

    /**
     * Sets the ipstart
     *
     * @param int $ipstart
     * @return void
     */
    public function setIpstart($ipstart)
    {
        $this->ipstart = $ipstart;
    }

}
