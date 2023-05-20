<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Collection;

use Netresearch\Sdk\CentralStation\Model\Company;

/**
 * A company collection.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractCollection<int, Company>
 */
class CompanyCollection extends AbstractCollection
{
    /**
     * Returns the company from the collection matching the given company ID.
     *
     * @param int $companyId
     *
     * @return null|Company
     */
    public function getById(int $companyId): ?Company
    {
        foreach ($this as $company) {
            if ($company->id === $companyId) {
                return $company;
            }
        }

        return null;
    }

    /**
     * Returns the company from the collection matching the given name.
     *
     * @param string $companyName
     *
     * @return null|Company
     */
    public function getByName(string $companyName): ?Company
    {
        foreach ($this as $company) {
            // Use multibyte strtolower in order to correctly convert German umlauts
            if (mb_strtolower($company->name, 'UTF-8') === mb_strtolower($companyName, 'UTF-8')) {
                return $company;
            }
        }

        return null;
    }
}
