<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Container;

use MagicSunday\JsonMapper\Annotation\ReplaceProperty;
use Netresearch\Sdk\CentralStation\Model\CalendarEvent;

/**
 * A calendar event container.
 *
 * This is only used in "index" requests, because in this case the API returns a list of
 * objects with sub objects, for whatever reason.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("calendarEvent", replaces="cal_event")
 */
class CalendarEventContainer
{
    /**
     * A calendar event.
     *
     * @var CalendarEvent
     */
    public $calendarEvent;
}
