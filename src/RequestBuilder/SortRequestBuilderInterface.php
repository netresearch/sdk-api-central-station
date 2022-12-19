<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

use Netresearch\Sdk\CentralStation\Constants;

/**
 * The sort request builder interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
interface SortRequestBuilderInterface extends RequestBuilderInterface
{
    /**
     * Sets the sort order of the response.
     *
     * @param null|string $orderBy        The order type (use one of Constants::ORDER_BY_*)
     * @param null|string $orderDirection The order direction (use one of Constants::ORDER_DIRECTION_*)
     *
     * @return self
     */
    public function setOrder(
        ?string $orderBy = Constants::ORDER_BY_NAME,
        ?string $orderDirection = Constants::ORDER_DIRECTION_ASC
    ): SortRequestBuilderInterface;
}
