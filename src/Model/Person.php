<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use MagicSunday\JsonMapper\Annotation\ReplaceProperty;
use Netresearch\Sdk\CentralStation\Model\Collection\AddressCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\CompanyCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\ContactDetailCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\CustomFieldCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\PositionCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\TagCollection;

/**
 * A person record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("addresses", replaces="addrs")
 * @ReplaceProperty("companyAddresses", replaces="addrs_from_company")
 * @ReplaceProperty("phoneNumbers", replaces="tels")
 */
class Person extends AbstractEntity
{
    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * The salutation of the person.
     *
     * @var null|string
     */
    public $salutation;

    /**
     * The title of the person.
     *
     * @var null|string
     */
    public $title;

    /**
     * The title of the person.
     *
     * @var null|string
     */
    public $gender;

    /**
     * The language of the person as ISO-639-1 code (e.g. de, en, fr or NULL).
     *
     * @var null|string
     */
    public $countryCode;

    /**
     * The first name of the person.
     *
     * @var null|string
     */
    public $firstName;

    /**
     * The last name of the person.
     *
     * @var string
     */
    public $name;

    /**
     * Background information about the person.
     *
     * @var null|string
     */
    public $background;

    /**
     * ID of the user if the person belongs to a user.
     *
     * @var null|int
     */
    public $userId;

    /**
     * A collection of tags assigned to the person.
     *
     * @var TagCollection<Tag>
     */
    public $tags;

    /**
     * A collection of positions assigned to the person.
     *
     * @var PositionCollection<Position>
     */
    public $positions;

    /**
     * A collection of companies assigned to the person.
     *
     * @var CompanyCollection<Company>
     */
    public $companies;

    /**
     * A collection of addresses assigned to the person.
     *
     * @var AddressCollection<Address>
     */
    public $addresses;

    /**
     * A collection of company addresses assigned to the person.
     *
     * @var AddressCollection<Address>
     */
    public $companyAddresses;

    /**
     * A collection of telephone numbers assigned to the person.
     *
     * @var ContactDetailCollection<ContactDetail>
     */
    public $phoneNumbers;

    /**
     * A collection of email addresses assigned to the person.
     *
     * @var ContactDetailCollection<ContactDetail>
     */
    public $emails;

    /**
     * A collection of homepages assigned to the person.
     *
     * @var ContactDetailCollection<ContactDetail>
     */
    public $homepages;

    /**
     * A collection of custom fields assigned to the person.
     *
     * @var CustomFieldCollection<CustomField>
     */
    public $customFields;
}
