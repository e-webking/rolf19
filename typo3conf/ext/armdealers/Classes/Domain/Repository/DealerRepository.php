<?php
namespace ARM\Armdealers\Domain\Repository;

/***
 *
 * This file is part of the "ARM Blog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019
 *
 ***/

/**
 * The repository for Dealer
 */
class DealerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * defaultOrderings
     *
     * @var array
     */
    protected $defaultOrderings = array("title"=> \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
    
}
