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
     * @var int|null
     */
    private ?int $id = null;

    /**
     * @var string|null
     */
    private ?string $street = null;

    /**
     * @var string|null
     */
    private ?string $zip = null;

    /**
     * @var string|null
     */
    private ?string $city = null;

    /**
     * @var string|null
     */
    private ?string $stateCode = null;

    /**
     * @var string|null
     */
    private ?string $countryCode = null;

    /**
     * @var bool
     */
    private bool $primary = false;

    /**
     * @var string|null
     */
    private ?string $type = null;

    /**
     * @param int|null $id
     *
     * @return Address
     */
    public function setId(?int $id): Address
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param string|null $street
     *
     * @return Address
     */
    public function setStreet(?string $street): Address
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @param string|null $zip
     *
     * @return Address
     */
    public function setZip(?string $zip): Address
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @param string|null $city
     *
     * @return Address
     */
    public function setCity(?string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string|null $stateCode
     *
     * @return Address
     */
    public function setStateCode(?string $stateCode): Address
    {
        $this->stateCode = $stateCode;

        return $this;
    }

    /**
     * @param string|null $countryCode
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
     * @param string|null $type
     *
     * @return Address
     */
    public function setType(?string $type): Address
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array<string, bool|int|string|null>
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
