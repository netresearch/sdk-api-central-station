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
 * The sort request interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
interface SortRequestInterface extends RequestInterface
{
    /**
     * @param null|string $orderBy
     *
     * @return self
     */
    public function setOrderBy(?string $orderBy): SortRequestInterface;

    /**
     * @param null|string $orderDirection
     *
     * @return self
     */
    public function setOrderDirection(?string $orderDirection): SortRequestInterface;
}
