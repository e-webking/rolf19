<?php
namespace ARM\Armdealers\Domain\Repository;

/***
 *
 * This file is part of the "ARM Blog" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2022
 *
 ***/

/**
 * The repository for productdealer
 */
class ProductdealerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    
    /**
     * defaultOrderings
     *
     * @var array
     */
    protected $defaultOrderings = array("sorting"=> \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
    
    /**
     * 
     * @param int $dealer
     * @param int $product
     * @return \ARM\Armdealers\Domain\Model\Productdealer
     */
    public function getDealerProduct($dealer,$product) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('hidden',0);
        $constraints[] = $query->equals('product',$product);
        $constraints[] = $query->equals('dealer',$dealer);
        $query->matching(
            $query->logicalAnd($constraints)
        );
        
        return $query->execute()->getFirst();
    }
}
