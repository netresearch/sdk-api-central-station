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
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $page;

    /**
     * @param int $perPage
     *
     * @return self
     */
    public function setPerPage(int $perPage): PaginationRequestInterface
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page): PaginationRequestInterface
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
        if (!empty($this->perPage)) {
            $data['perpage'] = $this->perPage;
        }

        if (!empty($this->page)) {
            $data['page'] = $this->page;
        }

        return $data;
    }
}
