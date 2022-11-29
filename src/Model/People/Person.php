<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\People;

use DateTime;

/**
 * A person record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Person
{
    /**
     * ID of a person.
     *
     * @var int
     */
    public $id;

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
     * Time of creation.
     *
     * @var DateTime
     */
    public $createdAt;

    /**
     * Time of last update.
     *
     * @var DateTime
     */
    public $updatedAt;
}
