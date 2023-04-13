<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\CalendarEvents;

use DateTime;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\CalendarEvent;
use Netresearch\Sdk\CentralStation\Request\CalendarEventAttendee;
use Netresearch\Sdk\CentralStation\Request\CalendarEventAttendees;
use Netresearch\Sdk\CentralStation\Request\CalendarEvents\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\CalendarEvents\CreateValidator;

/**
 * The request builder to create a valid "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class CreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the name of the calendar event.
     *
     * @param string $name The name of the calendar event
     *
     * @return CreateRequestBuilder
     */
    public function setName(string $name): CreateRequestBuilder
    {
        $this->data['calendarEvent']['name'] = $name;
        return $this;
    }

    /**
     * Sets the group calendar ID.
     *
     * @param string $groupCalendarId The group calendar ID
     *
     * @return CreateRequestBuilder
     */
    public function setGroupCalendarId(string $groupCalendarId): CreateRequestBuilder
    {
        $this->data['calendarEvent']['groupCalendarId'] = $groupCalendarId;
        return $this;
    }

    /**
     * Sets the location of the calendar event.
     *
     * @param string $location The location of the calendar event
     *
     * @return CreateRequestBuilder
     */
    public function setLocation(string $location): CreateRequestBuilder
    {
        $this->data['calendarEvent']['location'] = $location;
        return $this;
    }

    /**
     * Sets the description of the calendar event.
     *
     * @param string $description The description of the calendar event
     *
     * @return CreateRequestBuilder
     */
    public function setDescription(string $description): CreateRequestBuilder
    {
        $this->data['calendarEvent']['description'] = $description;
        return $this;
    }

    /**
     * Sets the status of the calendar event.
     *
     * @param string $status The status of the calendar event (use one of Constants::CALENDAR_EVENT_STATUS)
     *
     * @return CreateRequestBuilder
     */
    public function setStatus(string $status): CreateRequestBuilder
    {
        $this->data['calendarEvent']['status'] = $status;
        return $this;
    }

    /**
     * Sets the event's attachable info.
     *
     * @param DateTime $startsAt The start time of the event
     * @param DateTime $endsAt   The end time of the event
     *
     * @return CreateRequestBuilder
     */
    public function setEventDate(
        DateTime $startsAt,
        DateTime $endsAt
    ): CreateRequestBuilder {
        $this->data['calendarEvent']['startsAt'] = $startsAt;
        $this->data['calendarEvent']['endsAt'] = $endsAt;
        return $this;
    }

    /**
     * Set to TRUE, so CRM will send out email invitations to all attendees.
     *
     * @param bool $emailInvitations TRUE/FALSE whether to send invitation mails or not
     *
     * @return CreateRequestBuilder
     */
    public function setEmailInvitations(bool $emailInvitations): CreateRequestBuilder
    {
        $this->data['calendarEvent']['emailInvitations'] = $emailInvitations;
        return $this;
    }

    /**
     * Set to TRUE for events that last the whole day (eg. holidays).
     *
     * @param bool $allDay TRUE/FALSE whether the event lasts the whole day
     *
     * @return CreateRequestBuilder
     */
    public function setAllDay(bool $allDay): CreateRequestBuilder
    {
        $this->data['calendarEvent']['allDay'] = $allDay;
        return $this;
    }

    /**
     * Sets the attachable info.
     *
     * @param null|int    $id   The attachable ID
     * @param null|string $type The attachable type (use one of Constants::ATTACHABLE_TYPE)
     *
     * @return CreateRequestBuilder
     */
    public function setAttachable(
        int $id = null,
        string $type = null
    ): CreateRequestBuilder {
        $this->data['calendarEvent']['attachableId'] = $id;
        $this->data['calendarEvent']['attachableType'] = $type;
        return $this;
    }

    /**
     * Adds a calendar event attendee attribute.
     *
     * @param int $personId The ID of the person to attach to the event
     *
     * @return CreateRequestBuilder
     */
    public function addCalendarEventAttendee(int $personId): CreateRequestBuilder
    {
        if (!isset($this->data['calendarEvent']['calendarEventAttendees'])) {
            $this->data['calendarEvent']['calendarEventAttendees'] = [];
        }

        if (!in_array($personId, $this->data['calendarEvent']['calendarEventAttendees'], true)) {
            $this->data['calendarEvent']['calendarEventAttendees'][] = $personId;
        }

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return CreateRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): CreateRequest
    {
        // Validate the input
//        CreateValidator::validate($this->data);

        $calendarEvent = new CalendarEvent();
        $calendarEvent->setName($this->data['calendarEvent']['name'])
            ->setGroupCalendarId($this->data['calendarEvent']['groupCalendarId'])
            ->setStartsAt($this->data['calendarEvent']['startsAt'])
            ->setEndsAt($this->data['calendarEvent']['endsAt']);

        if (isset($this->data['calendarEvent']['status'])) {
            $calendarEvent->setStatus($this->data['calendarEvent']['status']);
        }

        if (isset($this->data['calendarEvent']['location'])) {
            $calendarEvent->setLocation($this->data['calendarEvent']['location']);
        }

        if (isset($this->data['calendarEvent']['description'])) {
            $calendarEvent->setDescription($this->data['calendarEvent']['description']);
        }

        if (isset($this->data['calendarEvent']['emailInvitations'])) {
            $calendarEvent->setEmailInvitations($this->data['calendarEvent']['emailInvitations']);
        }

        if (isset($this->data['calendarEvent']['allDay'])) {
            $calendarEvent->setAllDay($this->data['calendarEvent']['allDay']);
        }

        if (isset($this->data['calendarEvent']['attachableId'])) {
            $calendarEvent->setAttachableId($this->data['calendarEvent']['attachableId']);
        }

        if (isset($this->data['calendarEvent']['attachableType'])) {
            $calendarEvent->setAttachableType($this->data['calendarEvent']['attachableType']);
        }

        // Add calendar event attendees
        if (isset($this->data['calendarEvent']['calendarEventAttendees'])) {
            $calendarEventAttendees = [];

            foreach ($this->data['calendarEvent']['calendarEventAttendees'] as $personId) {
                $calendarEventAttendee = new CalendarEventAttendee();
                $calendarEventAttendee->setPersonId($personId);

                $calendarEventAttendees[] = $calendarEventAttendee;
            }

            $calendarEvent->setCalendarEventAttendees(
                new CalendarEventAttendees($calendarEventAttendees)
            );
        }

        // Assign values to request
        $request = new CreateRequest($calendarEvent);

        $this->data = [];

        return $request;
    }
}
