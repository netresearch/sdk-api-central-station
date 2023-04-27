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
 * A person object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Person implements JsonSerializable
{
    /**
     * @var null|string
     */
    private ?string $lastName = null;

    /**
     * @var null|string
     */
    private ?string $firstName = null;

    /**
     * @var null|string
     */
    private ?string $gender = null;

    /**
     * @var null|string
     */
    private ?string $title = null;

    /**
     * @var null|string
     */
    private ?string $salutation = null;

    /**
     * @var null|string
     */
    private ?string $countryCode = null;

    /**
     * @var null|string
     */
    private ?string $background = null;

    /**
     * @var null|Positions
     */
    private ?Positions $positions = null;

    /**
     * @var null|Tags
     */
    private ?Tags $tags = null;

    /**
     * @var null|ContactDetails
     */
    private ?ContactDetails $phoneNumbers = null;

    /**
     * @var null|ContactDetails
     */
    private ?ContactDetails $emailAddresses = null;

    /**
     * @var null|ContactDetails
     */
    private ?ContactDetails $homepages = null;

    /**
     * @var null|Addresses
     */
    private ?Addresses $addresses = null;

    /**
     * @var null|CustomFields
     */
    private ?CustomFields $customFields = null;

    /**
     * @param null|string $lastName
     *
     * @return Person
     */
    public function setLastName(?string $lastName): Person
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param null|string $firstName
     *
     * @return Person
     */
    public function setFirstName(?string $firstName): Person
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param null|string $gender
     *
     * @return Person
     */
    public function setGender(?string $gender): Person
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param null|string $title
     *
     * @return Person
     */
    public function setTitle(?string $title): Person
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param null|string $salutation
     *
     * @return Person
     */
    public function setSalutation(?string $salutation): Person
    {
        $this->salutation = $salutation;
        return $this;
    }

    /**
     * @param null|string $countryCode
     *
     * @return Person
     */
    public function setCountryCode(?string $countryCode): Person
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @param null|string $background
     *
     * @return Person
     */
    public function setBackground(?string $background): Person
    {
        $this->background = $background;
        return $this;
    }

    /**
     * @param null|Positions $positions
     *
     * @return Person
     */
    public function setPositions(?Positions $positions): Person
    {
        $this->positions = $positions;
        return $this;
    }

    /**
     * @param null|Tags $tags
     *
     * @return Person
     */
    public function setTags(?Tags $tags): Person
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param null|ContactDetails $phoneNumbers
     *
     * @return Person
     */
    public function setPhoneNumbers(?ContactDetails $phoneNumbers): Person
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }

    /**
     * @param null|ContactDetails $emailAddresses
     *
     * @return Person
     */
    public function setEmailAddresses(?ContactDetails $emailAddresses): Person
    {
        $this->emailAddresses = $emailAddresses;
        return $this;
    }

    /**
     * @param null|ContactDetails $homepages
     *
     * @return Person
     */
    public function setHomepages(?ContactDetails $homepages): Person
    {
        $this->homepages = $homepages;
        return $this;
    }

    /**
     * @param null|Addresses $addresses
     *
     * @return Person
     */
    public function setAddresses(?Addresses $addresses): Person
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * @param null|CustomFields $customFields
     *
     * @return Person
     */
    public function setCustomFields(?CustomFields $customFields): Person
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
            'name'                     => $this->lastName,
            'first_name'               => $this->firstName,
            'gender'                   => $this->gender,
            'title'                    => $this->title,
            'salutation'               => $this->salutation,
            'country_code'             => $this->countryCode,
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
