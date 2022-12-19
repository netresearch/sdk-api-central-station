<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Tags;

use Netresearch\Sdk\CentralStation\Api\IndexRequestInterface;

/**
 * A "list" request.
 *
 * TODO Keywords as a part of namespace are only allowed since PHP 8.0, so for the meanwhile this class
 *      is named "TagList" instead of "List"
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class TagList implements IndexRequestInterface
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
     * @var string
     */
    private $attachableType;

    /**
     * @param int $perPage
     *
     * @return TagList
     */
    public function setPerPage(int $perPage): TagList
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @param int $page
     *
     * @return TagList
     */
    public function setPage(int $page): TagList
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param string $orderBy
     *
     * @return TagList
     */
    public function setOrderBy(string $orderBy): TagList
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param string $orderDirection
     *
     * @return TagList
     */
    public function setOrderDirection(string $orderDirection): TagList
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * @param string $attachableType
     *
     * @return TagList
     */
    public function setAttachableType(string $attachableType): TagList
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @return array<string, int|string|array<string>|array<array<string>>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['perpage'] = $this->perPage;
        $data['page']    = $this->page;

        if (!empty($this->orderBy) && !empty($this->orderDirection)) {
            $data['order'] = $this->orderBy . '-' . $this->orderDirection;
        }

        if (!empty($this->attachableType)) {
            $data['attachable_type'] = $this->attachableType;
        }

        return $data;
    }
}
