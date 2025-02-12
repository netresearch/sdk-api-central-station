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
     * ID of an account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * The salutation of the person.
     *
     * @var string|null
     */
    public ?string $salutation = null;

    /**
     * The title of the person.
     *
     * @var string|null
     */
    public ?string $title = null;

    /**
     * The title of the person.
     *
     * @var string|null
     */
    public ?string $gender = null;

    /**
     * The language of the person as ISO-639-1 code (e.g. de, en, fr or NULL).
     *
     * @var string|null
     */
    public ?string $countryCode = null;

    /**
     * The first name of the person.
     *
     * @var string|null
     */
    public ?string $firstName = null;

    /**
     * The last name of the person.
     *
     * @var string
     */
    public string $name;

    /**
     * Background information about the person.
     *
     * @var string|null
     */
    public ?string $background = null;

    /**
     * ID of the user if the person belongs to a user.
     *
     * @var int|null
     */
    public ?int $userId = null;

    /**
     * A collection of tags assigned to the person.
     *
     * @var TagCollection<Tag>
     */
    public TagCollection $tags;

    /**
     * A collection of positions assigned to the person.
     *
     * @var PositionCollection<Position>
     */
    public PositionCollection $positions;

    /**
     * A collection of companies assigned to the person.
     *
     * @var CompanyCollection<Company>
     */
    public CompanyCollection $companies;

    /**
     * A collection of addresses assigned to the person.
     *
     * @var AddressCollection<Address>
     */
    public AddressCollection $addresses;

    /**
     * A collection of company addresses assigned to the person.
     *
     * @var AddressCollection<Address>
     */
    public AddressCollection $companyAddresses;

    /**
     * A collection of telephone numbers assigned to the person.
     *
     * @var ContactDetailCollection<ContactDetail>
     */
    public ContactDetailCollection $phoneNumbers;

    /**
     * A collection of email addresses assigned to the person.
     *
     * @var ContactDetailCollection<ContactDetail>
     */
    public ContactDetailCollection $emails;

    /**
     * A collection of homepages assigned to the person.
     *
     * @var ContactDetailCollection<ContactDetail>
     */
    public ContactDetailCollection $homepages;

    /**
     * A collection of custom fields assigned to the person.
     *
     * @var CustomFieldCollection<CustomField>
     */
    public CustomFieldCollection $customFields;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->tags             = new TagCollection();
        $this->positions        = new PositionCollection();
        $this->companies        = new CompanyCollection();
        $this->addresses        = new AddressCollection();
        $this->companyAddresses = new AddressCollection();
        $this->phoneNumbers     = new ContactDetailCollection();
        $this->emails           = new ContactDetailCollection();
        $this->homepages        = new ContactDetailCollection();
        $this->customFields     = new CustomFieldCollection();
    }
}
