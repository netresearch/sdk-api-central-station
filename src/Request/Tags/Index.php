<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Tags;

use Netresearch\Sdk\CentralStation\Request\FilterRequestInterface;
use Netresearch\Sdk\CentralStation\Request\PaginationRequestInterface;
use Netresearch\Sdk\CentralStation\Request\SortRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Traits\FilterTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\SortTrait;

/**
 * An "index" request to return all tags.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Index implements
    FilterRequestInterface,
    PaginationRequestInterface,
    SortRequestInterface
{
    use FilterTrait;
    use PaginationTrait;
    use SortTrait;

    /**
     * @return array<string, int|string|string[][]>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        $data = $this->addPaginationToSerializedData($data);
        $data = $this->addSortToSerializedData($data);
        $data = $this->addFilterToSerializedData($data);

        return $data;
    }
}
