<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

use JsonSerializable;

/**
 * A calendar event attendee object used to create/update a record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class CalendarEventAttendee implements JsonSerializable
{
    /**
     * The ID of the person attached to the calendar event.
     *
     * @var null|int
     */
    private ?int $personId = null;

    /**
     * @param null|int $personId
     *
     * @return CalendarEventAttendee
     */
    public function setPersonId(?int $personId): CalendarEventAttendee
    {
        $this->personId = $personId;
        return $this;
    }

    /**
     * @return array<string, null|int>
     */
    public function jsonSerialize(): array
    {
        return [
            'person_id' => $this->personId,
        ];
    }
}
