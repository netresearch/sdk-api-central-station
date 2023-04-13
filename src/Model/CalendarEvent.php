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
use Netresearch\Sdk\CentralStation\Model\Collection\CalendarEventAttendeeCollection;
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
    public string $id;

    /**
     * ID of account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * ID of the user which created the calendar event.
     *
     * @var int
     */
    public int $userId;

    /**
     * ID of the linked object, for example the person ID.
     *
     * @var null|int
     */
    public ?int $attachableId = null;

    /**
     * Type of linked object, e.g. Person.
     *
     * @var null|string
     */
    public ?string $attachableType = null;

    /**
     * ID of group entity.
     *
     * @var string
     */
    public string $groupCalendarId;

    /**
     * The number of assigned comments to this calendar event.
     *
     * @var int
     */
    public int $commentsCount;

    /**
     * The name of the calendar event.
     *
     * @var string
     */
    public string $name;

    /**
     * The location of the calendar event.
     *
     * @var null|string
     */
    public ?string $location = null;

    /**
     * Start time of the event.
     *
     * @var DateTime
     */
    public DateTime $startsAt;

    /**
     * End time of the event.
     *
     * @var DateTime
     */
    public DateTime $endsAt;

    /**
     * Status of the event: new or confirmed.
     *
     * @var string
     */
    public string $status;

    /**
     * True for events that last the whole day.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $allDay = false;

    /**
     * True if e-mail invitations should be sent automatically via the system.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $emailInvitations = false;

    /**
     * Description of the event.
     *
     * @var string
     */
    public string $description;

    /**
     * Time of creation.
     *
     * @var DateTime
     */
    public DateTime $createdAt;

    /**
     * Time of last update.
     *
     * @var DateTime
     */
    public DateTime $updatedAt;

    /**
     * @var null|User
     */
    public ?User $user = null;

    /**
     * @var UserCollection<User>
     */
    public UserCollection $users;

    /**
     * @var PersonCollection<Person>
     */
    public PersonCollection $people;

    /**
     * @var CalendarEventAttendeeCollection<CalendarEventAttendee>
     */
    public CalendarEventAttendeeCollection $eventAttendees;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->users = new UserCollection();
        $this->people = new PersonCollection();
        $this->eventAttendees = new CalendarEventAttendeeCollection();
    }
}
