<?php
namespace ARM\Armdealers\Controller;

/***
 *
 * This file is part of the "ARM Dealers" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021
 *
 ***/
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;
use \TYPO3\CMS\Core\Core\Environment;

/**
 * 
 */
class ImportController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * dealerRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\DealerRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $dealerRepository = null;
    
    /**
     * zipcodeRepository
     *
     * @var \ARM\Armdealers\Domain\Repository\ZipcodeRepository
     * @TYPO3\CMS\Extbase\Annotation\Inject
     */
    protected $zipcodeRepository = null;
    
    
    /**
     * Default action
     */
    public function rawAction()
    {
        
    }

    public function importAction() {
        
        if ($this->request->hasArgument('filepath')) {
            
            $filepath = $this->request->getArgument('filepath');
            $separator = $this->request->getArgument('separator');
            
            if ($filepath == "") {
                
                $this->addFlashMessage("No file information!",'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                
            } else {
                
                $completePath = Environment::getPublicPath().'/'.$filepath;
                
                if (is_file($completePath)) {
                    
                    $fileContent = @file_get_contents($completePath);
                    $lineArr = GeneralUtility::trimExplode("\n", $fileContent);
                    
                    if (count($lineArr) > 0) {
                        
                        $lineOne = $lineArr[0];
                        if ($this->checkColumnCount($lineOne, $separator)) {
                            
                            $table = 'tx_armdealers_domain_model_rawdata';
                            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
            
                            foreach($lineArr as $line) {
                                
                                $data = $this->getColumnData($line, $separator);
                                if (!is_null($data[0]) && !is_null($data[1]) && !is_null($data[2]) ) {
                                    $affectedRows = $queryBuilder->insert($table)
                                                ->values([
                                                   'pid' => $this->settings["storagePid"],
                                                   'dealertitel' => $data[0],
                                                   'adresse' => $data[1],
                                                   'postleitzahl' => $data[2],
                                                   'ort' => $data[3],
                                                   'iso2cn' => $data[4],
                                                   'land' => $data[5],
                                                   'telefon' => $data[6],
                                                   'email' => $data[7],
                                                   'lat' => $data[8],
                                                   'lng' => $data[9],
                                                   'formmsg' => $data[10],
                                                   'land2' => $data[12],
                                                   'plz' => $data[13],
                                                   'ville' => $data[14],
                                                   'kanton' => "",
                                                ])
                                                ->execute();
                                }
                            }
                            $this->addFlashMessage("Data imported successfully",'INFO',\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
                        } else {
                            $this->addFlashMessage("Incorrect column count!",'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                        }
                        
                    } else {
                        
                        $this->addFlashMessage("Not enough data in file!",'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                    }
                    
                } else {
                    $this->addFlashMessage("Valid file not found!",'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                }
            }
            
        } else {
            $this->addFlashMessage("No file information!",'ERROR',\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        }
        
        $this->redirect("raw");
    }
    
    /**
     * 
     * @param string $line
     * @param string $separator
     * @return bool
     */
    protected function checkColumnCount($line, $separator) {
        if ($separator == '\t') {
            $colArr = GeneralUtility::trimExplode("\t", $line);
        } else {
            $colArr = GeneralUtility::trimExplode($separator, $line);
        }
        return (count($colArr) == 15) ? true : false;
    }

    /**
     * 
     * @param string $line
     * @param string $separator
     * @return array 
     */
    protected function getColumnData($line, $separator) {
        
        if ($separator == '\t') {
            $colArr = GeneralUtility::trimExplode("\t", $line);
        } else {
            $colArr = GeneralUtility::trimExplode($separator, $line);
        }
        
        return $colArr;
    }
    
    /**
     * 
     */
    public function migrateAction() {
        //get all the records 
        $table = 'tx_armdealers_domain_model_rawdata';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->getRestrictions()->removeAll();
        $expr = $queryBuilder->expr();
        $andCond = $expr->andx();
        $andCond->add($expr->eq('deleted', 0));
        $andCond->add($expr->eq('processed',  0));
        //$andCond->add($expr->neq('dealertitel', "''"));
        $qbRes = $queryBuilder->select('*')
                            ->from($table)
                            ->andWhere($andCond)
                            ->andWhere('dealertitel != :empty')->setParameter('empty', serialize([]));
        $rows = $qbRes->execute()->fetchAll();
        
        if (count($rows) > 0) {
            foreach ($rows as $row) {
                $this->processRow($row);
            }
        }
    }
    
    protected function processRow($row) {
        
        $lnd2 = ($row['land2'] == 'Österreich')?'AUT':'CHE';
        $dealerObj = $this->dealerRepository->getByTitle($row['dealertitel']);
        if ($dealerObj instanceof \ARM\Armdealers\Domain\Model\Dealer) {
            $this->addFlashMessage("Dealer record found-".$row['dealertitel'],'INFO',\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            // the dealer already present check and insert the zip
            $zipCheck = $this->zipcodeRepository->checkZip($lnd2,$row['plz']);
            if ($zipCheck == 0) {
                $zipObj = GeneralUtility::makeInstance("ARM\\Armdealers\\Domain\\Model\\Zipcode");
                $zipObj->setPid($this->settings['storagePid']);

                $zipObj->setDealer($dealerObj);
                $zipObj->setCountry($lnd2);
                $zipObj->setCity($row['ville']);
                $zipObj->setZipcode($row['plz']);
                $zipObj->setCanton($row['kanton']);
                $this->zipcodeRepository->add($zipObj);
                $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
                $persistenceManager->persistAll();
                $this->addFlashMessage($row['plz']." - PLZ record added.",'INFO',\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            } else {
                $this->addFlashMessage($row['plz']." - PLZ record already present!",'INFO',\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            }
        } else {
            //add the dealer
            $zero = "0";
            $dealerObj = GeneralUtility::makeInstance("ARM\\Armdealers\\Domain\\Model\\Dealer");
            $dealerObj->setPid($this->settings['storagePid']);
            $dealerObj->setTitle($row['dealertitel']);
            $dealerObj->setStreet($row['adresse']);
            $dealerObj->setZip($row['postleitzahl']);
            $dealerObj->setCity($row['ort']);
            $dealerObj->setPhone($row['telefon']);
            $dealerObj->setEmail($row['email']);
            $dealerObj->setLat($row['lat']);
            $dealerObj->setLng($row['lng']);
            $dealerObj->setCountry($row['land']);
            $dealerObj->setIso2cn($row['iso2cn']);
            $dealerObj->setDispmsg($row['formmsg']);
            //$dealerObj->setPgurl('');
            //$dealerObj->setDealerpg($zero);
            
            $this->dealerRepository->add($dealerObj);
            $this->addFlashMessage($row['dealertitel']." - Dealer record added.",'INFO',\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            $zipObj = GeneralUtility::makeInstance("ARM\\Armdealers\\Domain\\Model\\Zipcode");
            $zipObj->setPid($this->settings['storagePid']);
            
            $zipObj->setDealer($dealerObj);
            $zipObj->setCountry($lnd2);
            $zipObj->setCity($row['ville']);
            $zipObj->setZipcode($row['plz']);
            $zipObj->setCanton($row['kanton']);
            $this->zipcodeRepository->add($zipObj);
            
            $this->addFlashMessage($row['plz']." - PLZ record added.",'INFO',\TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
            $persistenceManager->persistAll();
        }
        
        $table = 'tx_armdealers_domain_model_rawdata';
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        $queryBuilder->update($table)
                     ->where(
                        $queryBuilder->expr()->eq('uid', $row['uid'])
                    )
                    ->set('processed', 1)
                    ->execute();
    }
    
}
