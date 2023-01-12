<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

use JsonSerializable;

/**
 * A tag object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Tag implements JsonSerializable
{
    /**
     * @var null|string
     */
    private $name;

    /**
     * @var null|int
     */
    private $attachableId;

    /**
     * @var null|string
     */
    private $attachableType;

    /**
     * @param null|string $name
     *
     * @return Tag
     */
    public function setName(?string $name): Tag
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param null|int $attachableId
     *
     * @return Tag
     */
    public function setAttachableId(?int $attachableId): Tag
    {
        $this->attachableId = $attachableId;
        return $this;
    }

    /**
     * @param null|string $attachableType
     *
     * @return Tag
     */
    public function setAttachableType(?string $attachableType): Tag
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @return array<string, null|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'name'            => $this->name,
            'attachable_id'   => $this->attachableId,
            'attachable_type' => $this->attachableType,
        ];
    }
}
