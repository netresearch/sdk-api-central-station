<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;

/**
 * A index request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Index implements RequestInterface
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
     * @var string
     */
    private $orderBy;

    /**
     * @var string
     */
    private $orderDirection = 'asc';

    /**
     * @var array
     */
    private $filter;

    /**
     * @var string[]
     */
    private $includes;

    /**
     * @param int $perPage
     *
     * @return Index
     */
    public function setPerPage(int $perPage): Index
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @param int $page
     *
     * @return Index
     */
    public function setPage(int $page): Index
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param string $orderBy
     *
     * @return Index
     */
    public function setOrderBy(string $orderBy): Index
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param string $orderDirection
     *
     * @return Index
     */
    public function setOrderDirection(string $orderDirection): Index
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @param array $filter
     *
     * @return Index
     */
    public function setFilter(array $filter): Index
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @param string[] $includes
     *
     * @return Index
     */
    public function setIncludes(...$includes): Index
    {
        $this->includes = $includes;
        return $this;
    }

    /**
     * @return array<string, int|string>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['perpage'] = $this->perPage;
        $data['page']    = $this->page;

        if (!empty($this->orderBy) && !empty($this->orderDirection)) {
            $data['order'] = $this->orderBy . '-' . $this->orderDirection;
        }

        // TODO
//        if (!empty($this->filter)) {
//            $data['filter'] = implode(' ', $this->filter);
//        }

        if (!empty($this->includes)) {
            $data['includes'] = implode(' ', $this->includes);
        }

        return $data;
    }
}
