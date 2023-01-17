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
use Netresearch\Sdk\CentralStation\Model\Collection\CalendarEventCollection;

/**
 * A group calendar record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("calendarEvents", replaces="cal_events")
 */
class GroupCalendar
{
    /**
     * ID of entity.
     *
     * @var string
     */
    public $id;

    /**
     * The name of the group calendar.
     *
     * @var string
     */
    public $name;

    /**
     * Color options from one, two...twelve.
     *
     * @var string
     */
    public $colorType;

    /**
     * True for standard calendars that cannot be deleted.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public $readOnly = false;

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
     * A collection of all assigned calendar events.
     *
     * @var CalendarEventCollection<CalendarEvent>
     */
    public $calendarEvents;
}
