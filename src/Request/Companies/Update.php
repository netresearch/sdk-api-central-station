<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Companies;

use Netresearch\Sdk\CentralStation\Request\Company;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Update implements RequestInterface
{
    private ?Company $company = null;

    /**
     * @param Company $company
     *
     * @return Update
     */
    public function setCompany(Company $company): Update
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return array<string, array<string, string|array<int, array<string, bool|int|string|null>>|null>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->company instanceof Company) {
            $data['company'] = $this->company->jsonSerialize();
        }

        return $data;
    }
}
