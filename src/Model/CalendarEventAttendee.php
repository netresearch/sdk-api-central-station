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

/**
 * A calendar event record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("calendarEventId", replaces="cal_event_id")
 */
class CalendarEventAttendee
{
    /**
     * ID of entity.
     *
     * @var string
     */
    public string $id;

    /**
     * The calendard event ID.
     *
     * @var string
     */
    public string $calendarEventId;

    /**
     * ID of the user which created the calendar event.
     *
     * @var int
     */
    public int $userId;

    /**
     * ID of the linked person.
     *
     * @var int
     */
    public int $personId;

    /**
     * The email address of the linked person.
     *
     * @var string
     */
    public string $email;

    /**
     * Status of the event: new or confirmed.
     *
     * @var string
     */
    public string $status;
}
