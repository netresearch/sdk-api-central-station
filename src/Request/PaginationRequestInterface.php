<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

/**
 * The pagination request interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
interface PaginationRequestInterface extends RequestInterface
{
    /**
     * @param int $perPage
     *
     * @return self
     */
    public function setPerPage(int $perPage): PaginationRequestInterface;

    /**
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page): PaginationRequestInterface;
}
