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
use Netresearch\Sdk\CentralStation\Constants;

/**
 * A contact detail record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("contactType", replaces="atype")
 */
class ContactDetail extends AbstractEntity
{
    /**
     * The ID of the record the contact detail belongs to, e.g. person, company, offer or project.
     *
     * @var int
     */
    public int $attachableId;

    /**
     * The record type the contact detail belongs to. Must be either "Person", "Company", "Deal" or "Project".
     *
     * @var string
     */
    public string $attachableType;

    /**
     * The name (value) of the contact detail.
     *
     * @var string
     */
    public string $name;

    /**
     * The clean name (value) of the contact detail.
     *
     * @var string
     */
    public string $nameClean;

    /**
     * Another type of contact_details, e.g. for a phone number
     * (office, office_hq, mobile, fax, private, voip, skype, other).
     *
     * @var string
     * @see Constants::CONTACT_DETAILS_TYPE
     */
    public string $contactType;

    /**
     * Type of contact_details, e.g. Email, Im (instant messenger), Sm (social media), Tel or Homepage.
     *
     * @var string
     */
    public string $type;

    /**
     * States whether the contact detail has been added via the API or some sort of integration.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $apiInput = false;
}
