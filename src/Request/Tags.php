<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

use Netresearch\Sdk\CentralStation\Model\Collection\AbstractCollection;

/**
 * A list of tags.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 *
 * @extends AbstractCollection<int, Tag>
 */
class Tags extends AbstractCollection
{
    /**
     * Returns a PHP array representation of this collection.
     *
     * @return array<int, array<string, int|string|null>>
     */
    public function jsonSerialize(): array
    {
        return array_values(
            array_map(
                static fn (Tag $tag): array => $tag->jsonSerialize(),
                parent::jsonSerialize()
            )
        );
    }
}
