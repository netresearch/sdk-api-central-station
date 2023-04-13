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
use DateTimeInterface;
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
    private ?int $attachableId = null;

    /**
     * The record type the contact detail belongs to. Must be either Person or Company.
     *
     * @var null|string
     */
    private ?string $attachableType = null;

    /**
     * The value of the contact detail according to the selected type.
     *
     * @var null|string
     */
    private ?string $name = null;

    /**
     * The group calendar ID.
     *
     * @var null|string
     */
    private ?string $groupCalendarId = null;

    /**
     * Description of the location, can be an address, a Meeting room id or left blank.
     *
     * @var null|string
     */
    private ?string $location = null;

    /**
     * Can be new, confirmed, tentative or cancelled.
     *
     * @var null|string
     */
    private ?string $status = null;

    /**
     * Start time of the event.
     *
     * @var null|DateTime
     */
    private ?DateTime $startsAt = null;

    /**
     * End time of the event.
     *
     * @var null|DateTime
     */
    private ?DateTime $endsAt = null;

    /**
     * Set to true for events that last the whole day (eg. holidays).
     *
     * @var bool
     */
    private bool $allDay = false;

    /**
     * Set to true and CSCRM will send out email invitations to all attendees.
     *
     * @var bool
     */
    private bool $emailInvitations = false;

    /**
     * Details regarding the event, eg. agenda.
     *
     * @var null|string
     */
    private ?string $description = null;

    /**
     * @var null|CalendarEventAttendees
     */
    private ?CalendarEventAttendees $calendarEventAttendees = null;

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
        $startsAt = $this->startsAt instanceof DateTime
            ? $this->startsAt->format(DateTimeInterface::ATOM)
            : null;

        $endsAt = $this->endsAt instanceof DateTime
            ? $this->endsAt->format(DateTimeInterface::ATOM)
            : null;

        return [
            'attachable_id'     => $this->attachableId,
            'attachable_type'   => $this->attachableType,
            'name'              => $this->name,
            'group_calendar_id' => $this->groupCalendarId,
            'location'          => $this->location,
            'status'            => $this->status,
            'starts_at'         => $startsAt,
            'ends_at'           => $endsAt,
            'all_day'           => $this->allDay,
            'email_invitations' => $this->emailInvitations,
            'description'       => $this->description,

            'cal_event_attendees_attributes'
                => $this->calendarEventAttendees instanceof CalendarEventAttendees
                    ? $this->calendarEventAttendees->jsonSerialize()
                    : null,
        ];
    }
}
