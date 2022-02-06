<?php
namespace ARM\Armdealers\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2022
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Productdealer
 */
class Productdealer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * product
     *
     * @var \ARM\Armdealers\Domain\Model\Product
     */
    protected $product = null;
    
    /**
     * dealer
     *
     * @var \ARM\Armdealers\Domain\Model\Dealer
     */
    protected $dealer = null;

    /**
     * 
     * @var bool
     */
    protected $splprice;

    /**
     * Returns the sku
     *
     * @return bool $splprice
     */
    public function getSplprice() {
            return $this->splprice;
    }

    /**
     * Sets the sku
     *
     * @param bool $splprice
     * @return void
     */
    public function setSplprice($splprice) {
        $this->splprice = $splprice;
    }
    
    /**
     * Returns the product
     *
     * @return \ARM\Armdealers\Domain\Model\Product $product
     */
    public function getProduct() {
       return $this->product;
    }

    /**
     * Sets the product
     *
     * @param \ARM\Armdealers\Domain\Model\Product $product
     * @return void
     */
    public function setProduct(\ARM\Armdealers\Domain\Model\Product $product) {
       $this->product = $product;
    }

    /**
     * Returns the dealer
     *
     * @return \ARM\Armdealers\Domain\Model\Dealer $dealer
     */
    public function getDealer() {
       return $this->dealer;
    }

    /**
     * Sets the dealer
     *
     * @param \ARM\Armdealers\Domain\Model\Dealer $dealer
     * @return void
     */
    public function setDealer(\ARM\Armdealers\Domain\Model\Dealer $dealer) {
       $this->dealer = $dealer;
    }
    
}