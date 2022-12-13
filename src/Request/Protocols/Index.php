<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Protocols;

use Netresearch\Sdk\CentralStation\Request\IncludesRequestInterface;
use Netresearch\Sdk\CentralStation\Request\PaginationRequestInterface;
use Netresearch\Sdk\CentralStation\Request\SortRequestInterface;
use Netresearch\Sdk\CentralStation\Request\Traits\IncludesRequestTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\PaginationRequestTrait;
use Netresearch\Sdk\CentralStation\Request\Traits\SortRequestTrait;

/**
 * A "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Index implements
    IncludesRequestInterface,
    PaginationRequestInterface,
    SortRequestInterface
{
    use IncludesRequestTrait;
    use PaginationRequestTrait;
    use SortRequestTrait;

    /**
     * @return array<string, int|string>
     */
    public function jsonSerialize(): array
    {
        $data = [];
        $data = $this->addPaginationToSerializedData($data);
        $data = $this->addSortToSerializedData($data);
        $data = $this->addIncludesToSerializedData($data);

        return $data;
    }
}
