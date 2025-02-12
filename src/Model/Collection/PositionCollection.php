<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Collection;

use Netresearch\Sdk\CentralStation\Model\Position;

/**
 * A position collection.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractCollection<int, Position>
 */
class PositionCollection extends AbstractCollection
{
    /**
     * Returns the position from the collection matching the given position ID.
     *
     * @param int $positionId
     *
     * @return Position|null
     */
    public function getById(int $positionId): ?Position
    {
        foreach ($this as $position) {
            if ($position->id === $positionId) {
                return $position;
            }
        }

        return null;
    }

    /**
     * Returns TRUE if the collection contains a position which is the primary position of the person.
     *
     * @return bool
     */
    public function hasPrimaryFunction(): bool
    {
        foreach ($this as $position) {
            if ($position->primaryFunction) {
                return true;
            }
        }

        return false;
    }
}
