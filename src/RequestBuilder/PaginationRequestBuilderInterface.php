<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

/**
 * The pagination request builder interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
interface PaginationRequestBuilderInterface extends RequestBuilderInterface
{
    /**
     * Sets the limitations of the response.
     *
     * @param int $perPage The number of elements to return (default: 25)
     * @param int $page    The page number for which to return the results
     *
     * @return static
     */
    public function setLimit(int $perPage = 25, int $page = 1): PaginationRequestBuilderInterface;
}
