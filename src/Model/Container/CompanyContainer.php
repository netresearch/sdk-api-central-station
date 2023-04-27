<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Container;

use Netresearch\Sdk\CentralStation\Model\Company;

/**
 * A company container.
 *
 * This is only used in "index" requests, because in this case the API returns a list of
 * objects with sub objects, for whatever reason.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CompanyContainer
{
    /**
     * A company.
     *
     * @var Company
     */
    public Company $company;
}
