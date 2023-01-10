<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

use Netresearch\Sdk\CentralStation\Collection\AbstractCollection;

/**
 * A list of tags.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Tags extends AbstractCollection
{
    /**
     * Returns an PHP array representation of this collection.
     *
     * @return array<int, array<string, null|int|string>>
     */
    public function jsonSerialize(): array
    {
        return array_values(
            array_map(
                static function (Tag $tag): array {
                    return $tag->jsonSerialize();
                },
                parent::jsonSerialize()
            )
        );
    }
}
