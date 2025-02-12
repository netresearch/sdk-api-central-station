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
     * @var string|null
     */
    private ?string $lastName = null;

    /**
     * @var string|null
     */
    private ?string $firstName = null;

    /**
     * @var string|null
     */
    private ?string $gender = null;

    /**
     * @var string|null
     */
    private ?string $title = null;

    /**
     * @var string|null
     */
    private ?string $salutation = null;

    /**
     * @var string|null
     */
    private ?string $countryCode = null;

    /**
     * @var string|null
     */
    private ?string $background = null;

    /**
     * @var Positions|null
     */
    private ?Positions $positions = null;

    /**
     * @var Tags|null
     */
    private ?Tags $tags = null;

    /**
     * @var ContactDetails|null
     */
    private ?ContactDetails $phoneNumbers = null;

    /**
     * @var ContactDetails|null
     */
    private ?ContactDetails $emailAddresses = null;

    /**
     * @var ContactDetails|null
     */
    private ?ContactDetails $homepages = null;

    /**
     * @var Addresses|null
     */
    private ?Addresses $addresses = null;

    /**
     * @var CustomFields|null
     */
    private ?CustomFields $customFields = null;

    /**
     * @param string|null $lastName
     *
     * @return Person
     */
    public function setLastName(?string $lastName): Person
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @param string|null $firstName
     *
     * @return Person
     */
    public function setFirstName(?string $firstName): Person
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param string|null $gender
     *
     * @return Person
     */
    public function setGender(?string $gender): Person
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @param string|null $title
     *
     * @return Person
     */
    public function setTitle(?string $title): Person
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string|null $salutation
     *
     * @return Person
     */
    public function setSalutation(?string $salutation): Person
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * @param string|null $countryCode
     *
     * @return Person
     */
    public function setCountryCode(?string $countryCode): Person
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @param string|null $background
     *
     * @return Person
     */
    public function setBackground(?string $background): Person
    {
        $this->background = $background;

        return $this;
    }

    /**
     * @param Positions|null $positions
     *
     * @return Person
     */
    public function setPositions(?Positions $positions): Person
    {
        $this->positions = $positions;

        return $this;
    }

    /**
     * @param Tags|null $tags
     *
     * @return Person
     */
    public function setTags(?Tags $tags): Person
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @param ContactDetails|null $phoneNumbers
     *
     * @return Person
     */
    public function setPhoneNumbers(?ContactDetails $phoneNumbers): Person
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    /**
     * @param ContactDetails|null $emailAddresses
     *
     * @return Person
     */
    public function setEmailAddresses(?ContactDetails $emailAddresses): Person
    {
        $this->emailAddresses = $emailAddresses;

        return $this;
    }

    /**
     * @param ContactDetails|null $homepages
     *
     * @return Person
     */
    public function setHomepages(?ContactDetails $homepages): Person
    {
        $this->homepages = $homepages;

        return $this;
    }

    /**
     * @param Addresses|null $addresses
     *
     * @return Person
     */
    public function setAddresses(?Addresses $addresses): Person
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @param CustomFields|null $customFields
     *
     * @return Person
     */
    public function setCustomFields(?CustomFields $customFields): Person
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
