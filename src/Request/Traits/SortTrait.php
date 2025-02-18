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
     * @var string|null
     */
    private ?string $orderBy = null;

    /**
     * @var string|null
     */
    private ?string $orderDirection = 'asc';

    /**
     * @param string|null $orderBy
     *
     * @return SortRequestInterface
     */
    public function setOrderBy(?string $orderBy): SortRequestInterface
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * @param string|null $orderDirection
     *
     * @return SortRequestInterface
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
        if (
            ($this->orderBy !== null)
            && ($this->orderBy !== '')
            && ($this->orderDirection !== null)
            && ($this->orderDirection !== '')
        ) {
            $data['order'] = $this->orderBy . '-' . $this->orderDirection;
        }

        return $data;
    }
}
