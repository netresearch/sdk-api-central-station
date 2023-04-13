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
 * A contact detail object.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class ContactDetail implements JsonSerializable
{
    /**
     * The ID of the record.
     *
     * @var null|int
     */
    private ?int $id = null;

    /**
     * The ID of the record the contact detail belongs to.
     *
     * @var null|int
     */
    private ?int $attachableId = null;

    /**
     * The record type the contact detail belongs to. Must be either Person or Company.
     *
     * @var null|string
     */
    private ?string $attachableType = null;

    /**
     * The value of the contact detail according to the selected type.
     *
     * @var null|string
     */
    private ?string $name = null;

    /**
     * Must be one of office, office_hq, mobile, fax, private, voip, skype or other.
     *
     * @var null|string
     */
    private ?string $type = null;

    /**
     * @param null|int $id
     *
     * @return ContactDetail
     */
    public function setId(?int $id): ContactDetail
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param null|int $attachableId
     *
     * @return ContactDetail
     */
    public function setAttachableId(?int $attachableId): ContactDetail
    {
        $this->attachableId = $attachableId;
        return $this;
    }

    /**
     * @param null|string $attachableType
     *
     * @return ContactDetail
     */
    public function setAttachableType(?string $attachableType): ContactDetail
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @param null|string $name
     *
     * @return ContactDetail
     */
    public function setName(?string $name): ContactDetail
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param null|string $type
     *
     * @return ContactDetail
     */
    public function setType(?string $type): ContactDetail
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array<string, null|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'atype'           => $this->type,
            'attachable_id'   => $this->attachableId,
            'attachable_type' => $this->attachableType,
        ];
    }
}
