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
    
    /**
     * 
     * @param string $code
     * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getNotIso2cn($code) {
        
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->logicalNot($query->equals('iso2cn',$code));
        $constraints[] = $query->equals('hidden',0);
        $query->matching(
                $query->logicalAnd($constraints)
                );
        
        return $query->execute();
    }
    
    /**
     * 
     * @param string $title
     * @return \ARM\Armdealers\Domain\Model\Dealer
     */
    public function getByTitle($title) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('deleted',0);
        $constraints[] = $query->like('title',$title);
        
        $query->matching(
                $query->logicalAnd($constraints)
        );
        
        return $query->execute()->getFirst();
    }
    
    /**
     * 
     * @param int $feuser
     * @return \ARM\Armdealers\Domain\Model\Dealer
     */
    public function getByFeuser($feuser) {
        $query = $this->createQuery();
        $constraints = array();
        $constraints[] = $query->equals('deleted', 0);
        $constraints[] = $query->equals('feuser', $feuser);
        
        $query->matching(
                $query->logicalAnd($constraints)
        );
        
        return $query->execute()->getFirst();
    }
}
