<?php
namespace ARM\Armip2location\Domain\Repository;

/***
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2023
 ***/

/**
 * The repository for Ip
 */
class IpRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    
    /**
     * 
     * @param int $ip
     * @return \ARM\Armip2location\Domain\Model\Ip
     */
    public function getRecord($ip) {
        
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(FALSE);
        
        $constraints = [];

        $constraints[] = $query->lessThanOrEqual('ipstart', $ip);
        $constraints[] = $query->greaterThanOrEqual('ipend', $ip);
        
        $query->matching(
            $query->logicalAnd($constraints)
        );

        return $query->execute()->getFirst();
    }
}
