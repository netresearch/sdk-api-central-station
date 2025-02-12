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
    private ?string $name = null;

    private ?string $background = null;

    private ?Positions $positions = null;

    private ?Tags $tags = null;

    private ?ContactDetails $phoneNumbers = null;

    private ?ContactDetails $emailAddresses = null;

    private ?ContactDetails $homepages = null;

    private ?Addresses $addresses = null;

    private ?CustomFields $customFields = null;

    /**
     * @param string|null $name
     *
     * @return Company
     */
    public function setName(?string $name): Company
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $background
     *
     * @return Company
     */
    public function setBackground(?string $background): Company
    {
        $this->background = $background;

        return $this;
    }

    /**
     * @param Positions|null $positions
     *
     * @return Company
     */
    public function setPositions(?Positions $positions): Company
    {
        $this->positions = $positions;

        return $this;
    }

    /**
     * @param Tags|null $tags
     *
     * @return Company
     */
    public function setTags(?Tags $tags): Company
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param ContactDetails|null $phoneNumbers
     *
     * @return Company
     */
    public function setPhoneNumbers(?ContactDetails $phoneNumbers): Company
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    /**
     * @param ContactDetails|null $emailAddresses
     *
     * @return Company
     */
    public function setEmailAddresses(?ContactDetails $emailAddresses): Company
    {
        $this->emailAddresses = $emailAddresses;

        return $this;
    }

    /**
     * @param ContactDetails|null $homepages
     *
     * @return Company
     */
    public function setHomepages(?ContactDetails $homepages): Company
    {
        $this->homepages = $homepages;

        return $this;
    }

    /**
     * @param Addresses|null $addresses
     *
     * @return Company
     */
    public function setAddresses(?Addresses $addresses): Company
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @param CustomFields|null $customFields
     *
     * @return Company
     */
    public function setCustomFields(?CustomFields $customFields): Company
    {
        $this->customFields = $customFields;

        return $this;
    }

    /**
     * @return array<string, string|array<int, array<string, bool|int|string|null>>|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'name'                     => $this->name,
            'background'               => $this->background,
            'positions_attributes'     => $this->positions?->jsonSerialize(),
            'tags_attributes'          => $this->tags?->jsonSerialize(),
            'tels_attributes'          => $this->phoneNumbers?->jsonSerialize(),
            'emails_attributes'        => $this->emailAddresses?->jsonSerialize(),
            'homepages_attributes'     => $this->homepages?->jsonSerialize(),
            'addrs_attributes'         => $this->addresses?->jsonSerialize(),
            'custom_fields_attributes' => $this->customFields?->jsonSerialize(),
        ];
    }
}
