<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Traits;

use Netresearch\Sdk\CentralStation\Request\SortRequestInterface;

/**
 * The sort trait.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait SortTrait
{
    /**
     * @var null|string
     */
    private $orderBy;

    /**
     * @var null|string
     */
    private $orderDirection = 'asc';

    /**
     * @param null|string $orderBy
     *
     * @return self
     */
    public function setOrderBy(?string $orderBy): SortRequestInterface
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * @param null|string $orderDirection
     *
     * @return self
     */
    public function setOrderDirection(?string $orderDirection): SortRequestInterface
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

    /**
     * Adds the defined data to the data to be serialized and returns the updated structure.
     *
     * @param mixed[] $data The data to serialize
     *
     * @return mixed[]
     */
    private function addSortToSerializedData(array $data): array
    {
        if (!empty($this->orderBy) && !empty($this->orderDirection)) {
            $data['order'] = $this->orderBy . '-' . $this->orderDirection;
        }

        return $data;
    }
}
