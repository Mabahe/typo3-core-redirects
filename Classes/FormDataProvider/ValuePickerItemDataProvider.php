<?php
declare(strict_types = 1);
namespace TYPO3\CMS\Redirects\FormDataProvider;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Form\FormDataProviderInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Inject available domain hosts into a valuepicker form
 * @internal
 */
class ValuePickerItemDataProvider implements FormDataProviderInterface
{

    /**
     * Add sys_domains into $result data array
     *
     * @param array $result Initialized result array
     * @return array Result filled with more data
     */
    public function addData(array $result): array
    {
        if ($result['tableName'] === 'sys_redirect' && isset($result['processedTca']['columns']['source_host'])) {
            $domains = $this->getDomains();
            $pid = 0;
            $items = $result['processedTca']['columns']['source_host']['config']['valuePicker']['items'];
            foreach ($domains as $domain) {
                if ($pid !== $domain['pid']) {
                    $pid = $domain['pid'];
                    $items[] = [
                        '%site_root_' . $pid . '%',
                        '%site_root_' . $pid . '%'
                    ];
                }
                $items[] =
                    [
                        $domain['domainName'],
                        $domain['domainName'],
                    ];
            }
            $result['processedTca']['columns']['source_host']['config']['valuePicker']['items'] = $items;
        }
        return $result;
    }

    /**
     * Get sys_domain records from database, and all from pseudo-sites
     *
     * @return array domain records
     */
    protected function getDomains(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_domain');
        $domains = $queryBuilder
            ->select('domainName', 'pid')
            ->from('sys_domain')
            ->execute()
            ->fetchAll();
        return $domains;
    }

}
