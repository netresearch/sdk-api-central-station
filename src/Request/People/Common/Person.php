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
 * A person object used to create/update a record
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
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->lastName !== null) {
            $data['name'] = $this->lastName;
        }

        if ($this->firstName !== null) {
            $data['first_name'] = $this->firstName;
        }

        if ($this->gender !== null) {
            $data['gender'] = $this->gender;
        }

        if ($this->title !== null) {
            $data['title'] = $this->title;
        }

        return $data;
    }
}
