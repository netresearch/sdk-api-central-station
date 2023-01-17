<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use DateTime;
use MagicSunday\JsonMapper\Annotation\ReplaceNullWithDefaultValue;
use MagicSunday\JsonMapper\Annotation\ReplaceProperty;
use Netresearch\Sdk\CentralStation\Model\Collection\PersonCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\UserCollection;

/**
 * A calendar event record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("eventAttendees", replaces="cal_event_attendees")
 */
class CalendarEvent
{
    /**
     * ID of entity.
     *
     * @var string
     */
    public $id;

    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of the user which created the calendar event.
     *
     * @var int
     */
    public $userId;

    /**
     * ID of the linked object, for example the person ID.
     *
     * @var null|int
     */
    public $attachableId;

    /**
     * Type of linked object, e.g. Person.
     *
     * @var null|string
     */
    public $attachableType;

    /**
     * ID of group entity.
     *
     * @var string
     */
    public $groupCalendarId;

    /**
     * The number of assigned comments to this calendar event.
     *
     * @var int
     */
    public $commentsCount;

    /**
     * The name of the calendar event.
     *
     * @var string
     */
    public $name;

    /**
     * The location of the calendar event.
     *
     * @var null|string
     */
    public $location;

    /**
     * Start time of the event.
     *
     * @var DateTime
     */
    public $startsAt;

    /**
     * End time of the event.
     *
     * @var DateTime
     */
    public $endsAt;

    /**
     * Status of the event: new or confirmed.
     *
     * @var string
     */
    public $status;

    /**
     * True for events that last the whole day.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public $allDay = false;

    /**
     * True if e-mail invitations should be sent automatically via the system.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public $emailInvitations = false;

    /**
     * Description of the event.
     *
     * @var string
     */
    public $description;

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

    /**
     * @var User
     */
    public $user;

    /**
     * @var UserCollection<User>
     */
    public $users;

    /**
     * @var PersonCollection<Person>
     */
    public $people;

//    /**
//     * @var
//     */
//    public $eventAttendees;
}
