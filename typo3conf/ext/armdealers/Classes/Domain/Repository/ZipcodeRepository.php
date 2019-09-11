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
 * The repository for Zipcode
 */
class ZipcodeRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * defaultOrderings
     *
     * @var array
     */
    protected $defaultOrderings = array("zipcode"=> \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
    
    
    /**
     * 
     * @param string $zip
     * @param string $country
     */
    public function getByZipCountry($zip, $country) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('hidden',0);
        $constraints[] = $query->equals('zipcode', $zip);
        $constraints[] = $query->equals('country', $country);
        $query->matching(
                $query->logicalAnd($constraints)
        );

        return $query->execute();
    }
    
}
