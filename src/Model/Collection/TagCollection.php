<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Collection;

use Netresearch\Sdk\CentralStation\Model\Tag;

/**
 * A tag collection.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractCollection<int, Tag>
 */
class TagCollection extends AbstractCollection
{
    /**
     * Returns TRUE if the tag collection contains a tag of specified name.
     *
     * @param string $name The tag name to search for
     *
     * @return bool
     */
    public function hasTag(string $name): bool
    {
        /** @var Tag $tag */
        foreach ($this as $tag) {
            if ($tag->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns TRUE if the tag collection contains one of the specified tag names.
     *
     * @param string[] $names The list of tag names to search for
     *
     * @return bool
     */
    public function hasOneFromList(array $names): bool
    {
        foreach ($names as $name) {
            if ($this->hasTag($name) === true) {
                return true;
            }
        }

        return false;
    }
}
