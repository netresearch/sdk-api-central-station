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
     * @var int|null
     */
    private ?int $id = null;

    /**
     * The ID of the record the contact detail belongs to.
     *
     * @var int|null
     */
    private ?int $attachableId = null;

    /**
     * The record type the contact detail belongs to. Must be either Person or Company.
     *
     * @var string|null
     */
    private ?string $attachableType = null;

    /**
     * The value of the contact detail according to the selected type.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Must be one of office, office_hq, mobile, fax, private, voip, skype or other.
     *
     * @var string|null
     */
    private ?string $type = null;

    /**
     * @param int|null $id
     *
     * @return ContactDetail
     */
    public function setId(?int $id): ContactDetail
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param int|null $attachableId
     *
     * @return ContactDetail
     */
    public function setAttachableId(?int $attachableId): ContactDetail
    {
        $this->attachableId = $attachableId;

        return $this;
    }

    /**
     * @param string|null $attachableType
     *
     * @return ContactDetail
     */
    public function setAttachableType(?string $attachableType): ContactDetail
    {
        $this->attachableType = $attachableType;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return ContactDetail
     */
    public function setName(?string $name): ContactDetail
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $type
     *
     * @return ContactDetail
     */
    public function setType(?string $type): ContactDetail
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array<string, int|string|null>
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
