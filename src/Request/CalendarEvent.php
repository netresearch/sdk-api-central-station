<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

use DateTime;
use JsonSerializable;

/**
 * A calendar event object.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class CalendarEvent implements JsonSerializable
{
    /**
     * The ID of the record the contact detail belongs to.
     *
     * @var null|int
     */
    private $attachableId;

    /**
     * The record type the contact detail belongs to. Must be either Person or Company.
     *
     * @var null|string
     */
    private $attachableType;

    /**
     * The value of the contact detail according to the selected type.
     *
     * @var null|string
     */
    private $name;

    /**
     * The group calendar ID.
     *
     * @var null|string
     */
    private $groupCalendarId;

    /**
     * Description of the location, can be an address, a Meeting room id or left blank.
     *
     * @var null|string
     */
    private $location;

    /**
     * Can be new, confirmed, tentative or cancelled.
     *
     * @var null|string
     */
    private $status;

    /**
     * Start time of the event.
     *
     * @var null|DateTime
     */
    private $startsAt;

    /**
     * End time of the event.
     *
     * @var null|DateTime
     */
    private $endsAt;

    /**
     * Set to true for events that last the whole day (eg. holidays).
     *
     * @var bool
     */
    private $allDay = false;

    /**
     * Set to true and CSCRM will send out email invitations to all attendees.
     *
     * @var bool
     */
    private $emailInvitations = false;

    /**
     * Details regarding the event, eg. agenda.
     *
     * @var null|string
     */
    private $description;

    /**
     * @var null|CalendarEventAttendees
     */
    private $calendarEventAttendees;

    /**
     * @param null|int $attachableId
     *
     * @return CalendarEvent
     */
    public function setAttachableId(?int $attachableId): CalendarEvent
    {
        $this->attachableId = $attachableId;
        return $this;
    }

    /**
     * @param null|string $attachableType
     *
     * @return CalendarEvent
     */
    public function setAttachableType(?string $attachableType): CalendarEvent
    {
        $this->attachableType = $attachableType;
        return $this;
    }

    /**
     * @param null|string $name
     *
     * @return CalendarEvent
     */
    public function setName(?string $name): CalendarEvent
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param null|string $groupCalendarId
     *
     * @return CalendarEvent
     */
    public function setGroupCalendarId(?string $groupCalendarId): CalendarEvent
    {
        $this->groupCalendarId = $groupCalendarId;
        return $this;
    }

    /**
     * @param null|string $location
     *
     * @return CalendarEvent
     */
    public function setLocation(?string $location): CalendarEvent
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @param null|string $status
     *
     * @return CalendarEvent
     */
    public function setStatus(?string $status): CalendarEvent
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param null|DateTime $startsAt
     *
     * @return CalendarEvent
     */
    public function setStartsAt(?DateTime $startsAt): CalendarEvent
    {
        $this->startsAt = $startsAt;
        return $this;
    }

    /**
     * @param null|DateTime $endsAt
     *
     * @return CalendarEvent
     */
    public function setEndsAt(?DateTime $endsAt): CalendarEvent
    {
        $this->endsAt = $endsAt;
        return $this;
    }

    /**
     * @param bool $allDay
     *
     * @return CalendarEvent
     */
    public function setAllDay(bool $allDay): CalendarEvent
    {
        $this->allDay = $allDay;
        return $this;
    }

    /**
     * @param bool $emailInvitations
     *
     * @return CalendarEvent
     */
    public function setEmailInvitations(bool $emailInvitations): CalendarEvent
    {
        $this->emailInvitations = $emailInvitations;
        return $this;
    }

    /**
     * @param null|string $description
     *
     * @return CalendarEvent
     */
    public function setDescription(?string $description): CalendarEvent
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param null|CalendarEventAttendees $calendarEventAttendees
     *
     * @return CalendarEvent
     */
    public function setCalendarEventAttendees(?CalendarEventAttendees $calendarEventAttendees): CalendarEvent
    {
        $this->calendarEventAttendees = $calendarEventAttendees;
        return $this;
    }

    /**
     * @return array<string, null|bool|int|string|array<int, array<string, null|int>>>
     */
    public function jsonSerialize(): array
    {
        return [
            'attachable_id'     => $this->attachableId,
            'attachable_type'   => $this->attachableType,
            'name'              => $this->name,
            'group_calendar_id' => $this->groupCalendarId,
            'location'          => $this->location,
            'status'            => $this->status,
            'starts_at'         => $this->startsAt ? $this->startsAt->format('c') : null,
            'ends_at'           => $this->endsAt ? $this->endsAt->format('c') : null,
            'all_day'           => $this->allDay,
            'email_invitations' => $this->emailInvitations,
            'description'       => $this->description,

            'cal_event_attendees_attributes'
                => $this->calendarEventAttendees ? $this->calendarEventAttendees->jsonSerialize() : null,
        ];
    }
}
