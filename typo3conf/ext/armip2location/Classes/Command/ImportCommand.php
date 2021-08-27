<?php
namespace ARM\Armip2location\Command;

/***************************************************************
 *  Copyright notice
*
*  (c) 2021
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
 *
 *
 * @package typo3
 * @subpackage armip2location
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
*
*/
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class ImportCommand extends Command {
    
    /**
     *
     * @var string
     */
    protected $table = 'tx_armip2location_domain_model_ip';

    /**
     * Setup
     */
    protected function configure()
    {
        $this->setDescription('Import the IP database from the CSV file.')
             ->addArgument('fileName',
                InputArgument::OPTIONAL,
                'Please enter the CSV File');
    }
    
    /**
     * Executes the command for showing sys_log entries
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('fileName')) {
            $fileName = $input->getArgument('fileName');
            $path = Environment::getPublicPath() . '/fileadmin/armip2location/' . $fileName;

            if (is_file($path) && file_exists($path)) {
                $fileLineArr = file($path);
                foreach($fileLineArr as $line) {
                    $this->processLine($line);
                }
            }
            
            return 0; //Command::SUCCESS (v10)
        } else {
            return 1; //Command::FAILURE
        }
    }

    /**
     * 
     * @param \string $line
     */
    protected function processLine($line) {
        
        $colArr = GeneralUtility::trimExplode(",", $line);
        $ipstart = str_replace('"', '', $colArr[0]);
        $ipend = str_replace('"', '', $colArr[1]);
        $iso2cn = str_replace('"', '', $colArr[2]);
        $country = str_replace('"', '', $colArr[3]);

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($this->table);
        $queryBuilder->getRestrictions()->removeAll();
        $expr = $queryBuilder->expr();
        /*$cnt = $queryBuilder->count('uid')
                    ->from($this->table)
                    ->where(
                        $expr->eq('deleted', 0),
                        $expr->eq('hidden', 0),
                        $expr->eq('ipstart', $queryBuilder->createNamedParameter($ipstart))
                    )->execute()->fetchColumn(0);

        if ($cnt == 0) {*/
            $queryBuilder->insert($this->table)
                    ->values([
                        'pid' => 68,
                        'ipstart' => $ipstart,
                        'ipend' => $ipend,
                        'cn2iso' => $iso2cn,
                        'country' => $country,
                     ])
                     ->execute();
        //}
    }
}
