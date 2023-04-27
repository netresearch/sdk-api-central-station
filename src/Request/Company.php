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
 * A company object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Company implements JsonSerializable
{
    /**
     * @var null|string
     */
    private $name;

    /**
     * @var null|string
     */
    private $background;

    /**
     * @var null|Positions
     */
    private $positions;

    /**
     * @var null|Tags
     */
    private $tags;

    /**
     * @var null|ContactDetails
     */
    private $phoneNumbers;

    /**
     * @var null|ContactDetails
     */
    private $emailAddresses;

    /**
     * @var null|ContactDetails
     */
    private $homepages;

    /**
     * @var null|Addresses
     */
    private $addresses;

    /**
     * @var null|CustomFields
     */
    private $customFields;

    /**
     * @param null|string $name
     *
     * @return Company
     */
    public function setName(?string $name): Company
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param null|string $background
     *
     * @return Company
     */
    public function setBackground(?string $background): Company
    {
        $this->background = $background;
        return $this;
    }

    /**
     * @param null|Positions $positions
     *
     * @return Company
     */
    public function setPositions(?Positions $positions): Company
    {
        $this->positions = $positions;
        return $this;
    }

    /**
     * @param null|Tags $tags
     *
     * @return Company
     */
    public function setTags(?Tags $tags): Company
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param null|ContactDetails $phoneNumbers
     *
     * @return Company
     */
    public function setPhoneNumbers(?ContactDetails $phoneNumbers): Company
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }

    /**
     * @param null|ContactDetails $emailAddresses
     *
     * @return Company
     */
    public function setEmailAddresses(?ContactDetails $emailAddresses): Company
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }

    /**
     * @param null|ContactDetails $homepages
     *
     * @return Company
     */
    public function setHomepages(?ContactDetails $homepages): Company
    {
        $this->homepages = $homepages;
        return $this;
    }

    /**
     * @param null|Addresses $addresses
     *
     * @return Company
     */
    public function setAddresses(?Addresses $addresses): Company
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * @param null|CustomFields $customFields
     *
     * @return Company
     */
    public function setCustomFields(?CustomFields $customFields): Company
    {
        $this->customFields = $customFields;
        return $this;
    }

    /**
     * @return array<string, null|string|array<int, array<string, null|bool|int|string>>>
     */
    public function jsonSerialize(): array
    {
        return [
            'name'       => $this->name,
            'background' => $this->background,

            'positions_attributes'     => $this->positions ? $this->positions->jsonSerialize() : null,
            'tags_attributes'          => $this->tags ? $this->tags->jsonSerialize() : null,
            'tels_attributes'          => $this->phoneNumbers ? $this->phoneNumbers->jsonSerialize() : null,
            'emails_attributes'        => $this->emailAddresses ? $this->emailAddresses->jsonSerialize() : null,
            'homepages_attributes'     => $this->homepages ? $this->homepages->jsonSerialize() : null,
            'addrs_attributes'         => $this->addresses ? $this->addresses->jsonSerialize() : null,
            'custom_fields_attributes' => $this->customFields ? $this->customFields->jsonSerialize() : null,
        ];
    }
}
