<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Traits;

use Netresearch\Sdk\CentralStation\Request\PaginationRequestInterface;

/**
 * The pagination trait.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait PaginationTrait
{
    /**
     * @var int|null
     */
    private ?int $perPage = null;

    /**
     * @var int|null
     */
    private ?int $page = null;

    /**
     * @param int|null $perPage
     *
     * @return PaginationRequestInterface
     */
    public function setPerPage(?int $perPage): PaginationRequestInterface
    {
        $this->perPage = $perPage;

        return $this;
    }

    /**
     * @param int|null $page
     *
     * @return PaginationRequestInterface
     */
    public function setPage(?int $page): PaginationRequestInterface
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Adds the defined data to the data to be serialized and returns the updated structure.
     *
     * @param mixed[] $data The data to serialize
     *
     * @return mixed[]
     */
    private function addPaginationToSerializedData(array $data): array
    {
        if (($this->perPage !== null) && ($this->perPage !== 0)) {
            $data['perpage'] = $this->perPage;
        }

        if (($this->page !== null) && ($this->page !== 0)) {
            $data['page'] = $this->page;
        }

        return $data;
    }
}
