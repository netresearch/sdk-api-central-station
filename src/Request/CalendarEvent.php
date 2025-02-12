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
     * @var int|null
     */
    private ?int $attachableId = null;

    /**
     * The record type the contact detail belongs to. Must be either Person or Company.
     *
     * @var string|null
     */
    private ?string $attachableType = null;

    /**
     * The value of the contact detail according to the selected type.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * The group calendar ID.
     *
     * @var string|null
     */
    private ?string $groupCalendarId = null;

    /**
     * Description of the location. Can be an address, a meeting room id or left blank.
     *
     * @var string|null
     */
    private ?string $location = null;

    /**
     * Can be new, confirmed, tentative or canceled.
     *
     * @var string|null
     */
    private ?string $status = null;

    /**
     * Start time of the event.
     *
     * @var DateTime|null
     */
    private ?DateTime $startsAt = null;

    /**
     * End time of the event.
     *
     * @var DateTime|null
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
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @var CalendarEventAttendees|null
     */
    private ?CalendarEventAttendees $calendarEventAttendees = null;

    /**
     * @param int|null $attachableId
     *
     * @return CalendarEvent
     */
    public function setAttachableId(?int $attachableId): CalendarEvent
    {
        $this->attachableId = $attachableId;

        return $this;
    }

    /**
     * @param string|null $attachableType
     *
     * @return CalendarEvent
     */
    public function setAttachableType(?string $attachableType): CalendarEvent
    {
        $this->attachableType = $attachableType;

        return $this;
    }

    /**
     * @param string|null $name
     *
     * @return CalendarEvent
     */
    public function setName(?string $name): CalendarEvent
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $groupCalendarId
     *
     * @return CalendarEvent
     */
    public function setGroupCalendarId(?string $groupCalendarId): CalendarEvent
    {
        $this->groupCalendarId = $groupCalendarId;

        return $this;
    }

    /**
     * @param string|null $location
     *
     * @return CalendarEvent
     */
    public function setLocation(?string $location): CalendarEvent
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @param string|null $status
     *
     * @return CalendarEvent
     */
    public function setStatus(?string $status): CalendarEvent
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param DateTime|null $startsAt
     *
     * @return CalendarEvent
     */
    public function setStartsAt(?DateTime $startsAt): CalendarEvent
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * @param DateTime|null $endsAt
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
     * @param string|null $description
     *
     * @return CalendarEvent
     */
    public function setDescription(?string $description): CalendarEvent
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param CalendarEventAttendees|null $calendarEventAttendees
     *
     * @return CalendarEvent
     */
    public function setCalendarEventAttendees(?CalendarEventAttendees $calendarEventAttendees): CalendarEvent
    {
        $this->calendarEventAttendees = $calendarEventAttendees;

        return $this;
    }

    /**
     * @return array<string, bool|int|string|array<int, array<string, int|null>>|null>
     */
    public function jsonSerialize(): array
    {
        return [
            'attachable_id'                  => $this->attachableId,
            'attachable_type'                => $this->attachableType,
            'name'                           => $this->name,
            'group_calendar_id'              => $this->groupCalendarId,
            'location'                       => $this->location,
            'status'                         => $this->status,
            'starts_at'                      => $this->startsAt?->format(DateTimeInterface::ATOM),
            'ends_at'                        => $this->endsAt?->format(DateTimeInterface::ATOM),
            'all_day'                        => $this->allDay,
            'email_invitations'              => $this->emailInvitations,
            'description'                    => $this->description,
            'cal_event_attendees_attributes' => $this->calendarEventAttendees?->jsonSerialize(),
        ];
    }
}
