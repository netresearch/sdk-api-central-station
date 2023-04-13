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
use Netresearch\Sdk\CentralStation\Model\Collection\ContactDetailCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\CustomFieldCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\PositionCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\TagCollection;

/**
 * A company record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("addresses", replaces="addrs")
 * @ReplaceProperty("phoneNumbers", replaces="tels")
 */
class Company extends AbstractEntity
{
    /**
     * ID of account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * ID of group.
     *
     * @var int
     */
    public int $groupId;

    /**
     * ID of the user which created the entry.
     *
     * @var null|int
     */
    public ?int $userId = null;

    /**
     * The name of the company.
     *
     * @var string
     */
    public string $name;

    /**
     * Details about the company e.g. history.
     *
     * @var null|string
     */
    public ?string $background = null;

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
     * A collection of addresses assigned to the person.
     *
     * @var AddressCollection<Address>
     */
    public AddressCollection $addresses;

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
        $this->tags = new TagCollection();
        $this->positions = new PositionCollection();
        $this->addresses = new AddressCollection();
        $this->phoneNumbers = new ContactDetailCollection();
        $this->emails = new ContactDetailCollection();
        $this->homepages = new ContactDetailCollection();
        $this->customFields = new CustomFieldCollection();
    }
}
