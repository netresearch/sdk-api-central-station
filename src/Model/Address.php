<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use MagicSunday\JsonMapper\Annotation\ReplaceNullWithDefaultValue;
use MagicSunday\JsonMapper\Annotation\ReplaceProperty;

/**
 * An address record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("type", replaces="atype")
 */
class Address extends AbstractEntity
{
    /**
     * The ID of the record the address belongs to.
     *
     * @var int
     */
    public int $attachableId;

    /**
     * The record type the address belongs to. Must be either "Person" or "Company".
     *
     * @var string
     */
    public string $attachableType;

    /**
     * The street including the house number or other details (building, c/o).
     *
     * @var string
     *
     * @ReplaceNullWithDefaultValue
     */
    public string $street = '';

    /**
     * The zip code.
     *
     * @var string
     *
     * @ReplaceNullWithDefaultValue
     */
    public string $zip = '';

    /**
     * The city name.
     *
     * @var string
     *
     * @ReplaceNullWithDefaultValue
     */
    public string $city = '';

    /**
     * The state code (eg. NW, BY). Must match the county code.
     *
     * @var null|string
     */
    public ?string $stateCode = null;

    /**
     * The country code (eg. DE, AT).
     *
     * @var string
     *
     * @ReplaceNullWithDefaultValue
     */
    public string $countryCode = '';

    /**
     * The country name.
     *
     * @var string
     *
     * @ReplaceNullWithDefaultValue
     */
    public string $countryName = '';

    /**
     * Decides about the order of addresses when the attachable (Person or Company) has multiple addresses.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $primary = false;

    /**
     * Type of address: work_hq, work, invoice, delivery, private or other.
     *
     * @var string
     * @see Constants::ADDRESS_TYPE
     */
    public string $type;

    /**
     * States whether the address has been added via the API or some sort of integration.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $apiInput = false;
}
