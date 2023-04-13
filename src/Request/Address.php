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
 * An address object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Address implements JsonSerializable
{
    /**
     * The ID of the record.
     *
     * @var null|int
     */
    private ?int $id = null;

    /**
     * @var null|string
     */
    private ?string $street = null;

    /**
     * @var null|string
     */
    private ?string $zip = null;

    /**
     * @var null|string
     */
    private ?string $city = null;

    /**
     * @var null|string
     */
    private ?string $stateCode = null;

    /**
     * @var null|string
     */
    private ?string $countryCode = null;

    /**
     * @var bool
     */
    private bool $primary = false;

    /**
     * @var null|string
     */
    private ?string $type = null;

    /**
     * @param null|int $id
     *
     * @return Address
     */
    public function setId(?int $id): Address
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param null|string $street
     *
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param null|string $zip
     *
     * @return Address
     */
    public function setZip(?string $zip): Address
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @param null|string $city
     *
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param null|string $stateCode
     *
     * @return Address
     */
    public function setStateCode(?string $stateCode): Address
    {
        $this->stateCode = $stateCode;
        return $this;
    }

    /**
     * @param null|string $countryCode
     *
     * @return Address
     */
    public function setCountryCode(?string $countryCode): Address
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * @param bool $primary
     *
     * @return Address
     */
    public function setPrimary(bool $primary): Address
    {
        $this->primary = $primary;
        return $this;
    }

    /**
     * @param null|string $type
     *
     * @return Address
     */
    public function setType(?string $type): Address
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array<string, null|bool|int|string>
     */
    public function jsonSerialize(): array
    {
        return [
            'id'           => $this->id,
            'street'       => $this->street,
            'zip'          => $this->zip,
            'city'         => $this->city,
            'state_code'   => $this->stateCode,
            'country_code' => $this->countryCode,
            'atype'        => $this->type,
            'primary'      => $this->primary,
        ];
    }
}
