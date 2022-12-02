<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People\Common;

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
    private $lastName;

    /**
     * @var null|string
     */
    private $firstName;

    /**
     * @var null|string
     */
    private $gender;

    /**
     * @var null|string
     */
    private $title;

    /**
     * @var null|string
     */
    private $salutation;

    /**
     * @var null|string
     */
    private $countryCode;

    /**
     * @var null|string
     */
    private $background;

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
     * @return array<string, null|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'name'         => $this->lastName,
            'first_name'   => $this->firstName,
            'gender'       => $this->gender,
            'title'        => $this->title,
            'salutation'   => $this->salutation,
            'country_code' => $this->countryCode,
            'background'   => $this->background,
        ];
    }
}
