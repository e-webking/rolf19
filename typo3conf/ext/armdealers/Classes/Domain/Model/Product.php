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
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * sku
     *
     * @var string
     */
    protected $sku = '';
    
    /**
     * description
     *
     * @var string
     */
    protected $description = '';
    
    /**
     * coverphoto
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $coverphoto = NULL;

    /**
     * preview
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $preview = NULL;
    
    /**
     * images
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $images = NULL;
    
    /**
     * pdf
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $pdf = NULL;
    
    /**
     * video
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $video = NULL;
    
    /**
     * 
     * @var bool
     */
    protected $splprice;

    /**
     * mtitle
     *
     * @var string
     */
    protected $mtitle = '';
    
    /**
     * mdescription
     *
     * @var string
     */
    protected $mdescription = '';
    
    /**
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Dealer>
     */
    protected $dealers;
    
    /**
     * __construct
     */
    public function __construct() {
           //Do not remove the next line: It would break the functionality
           $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     *
     * @return void
     */
    protected function initStorageObjects() {
           $this->dealers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle() {
            return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title) {
            $this->title = $title;
    }

    /**
     * Returns the sku
     *
     * @return string $sku
     */
    public function getSku() {
            return $this->sku;
    }

    /**
     * Sets the sku
     *
     * @param string $sku
     * @return void
     */
    public function setSku($sku) {
            $this->sku = $sku;
    }
    
    
    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription() {
            return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description) {
            $this->description = $description;
    }
    
    /**
     * Returns the coverphoto
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $coverphoto
     */
    public function getCoverphoto() {
            return $this->coverphoto;
    }

    /**
     * Sets the coverphoto
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $coverphoto
     * @return void
     */
    public function setCoverphoto(\TYPO3\CMS\Extbase\Domain\Model\FileReference $coverphoto) {
            $this->coverphoto = $coverphoto;
    }
    
    /**
     * Returns the preview
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $preview
     */
    public function getPreview() {
            return $this->preview;
    }

    /**
     * Sets the preview
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $preview
     * @return void
     */
    public function setPreview(\TYPO3\CMS\Extbase\Domain\Model\FileReference $preview) {
            $this->preview = $preview;
    }

    /**
     * Returns the images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage $preview
     */
    public function getImages() {
            return $this->images;
    }
    
    /**
     * Returns the pdf
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $pdf
     */
    public function getPdf() {
            return $this->pdf;
    }

    /**
     * Sets the pdf
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $pdf
     * @return void
     */
    public function setPdf(\TYPO3\CMS\Extbase\Domain\Model\FileReference $pdf) {
            $this->pdf = $pdf;
    }
    
    /**
     * Returns the video
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $video
     */
    public function getVideo() {
            return $this->video;
    }

    /**
     * Sets the video
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $video
     * @return void
     */
    public function setVideo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $video) {
            $this->video = $video;
    }
    
    /**
     * Returns the mtitle
     *
     * @return string $mtitle
     */
    public function getMtitle() {
            return $this->mtitle;
    }

    /**
     * Sets the mtitle
     *
     * @param string $mtitle
     * @return void
     */
    public function setMtitle($mtitle) {
            $this->mtitle = $mtitle;
    }
    
    /**
     * Returns the mdescription
     *
     * @return string $mdescription
     */
    public function getMdescription() {
            return $this->mdescription;
    }

    /**
     * Sets the mdescription
     *
     * @param string $mdescription
     * @return void
     */
    public function setMdescription($mdescription) {
            $this->mdescription = $mdescription;
    }
    
    /**
     * Adds a Dealer
     *
     * @param \ARM\Armdealers\Domain\Model\Dealer $dealer
     * @return void
     */
    public function addDealer(\ARM\Armdealers\Domain\Model\Dealer $dealer) {
           $this->dealers->attach($dealer);
    }

    /**
     * Removes a Dealer
     *
     * @param \ARM\Armdealers\Domain\Model\Dealer $dealerToRemove The Dealer to be removed
     * @return void
     */
    public function removeDealer(\ARM\Armdealers\Domain\Model\Dealer $dealerToRemove) {
       $this->dealers->detach($dealerToRemove);
    }

    /**
     * Returns the dealers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Dealer> $dealers
     */
    public function getDealers() {
       return $this->dealers;
    }

    /**
     * Sets the dealers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ARM\Armdealers\Domain\Model\Dealer> $dealers
     * @return void
     */
    public function setDealers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dealers) {
       $this->dealers = $dealers;
    }
    
}