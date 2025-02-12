<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\CalendarEvents;

use Netresearch\Sdk\CentralStation\Request\CalendarEvent;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Update implements RequestInterface
{
    /**
     * @var CalendarEvent|null
     */
    private ?CalendarEvent $calendarEvent = null;

    /**
     * @param CalendarEvent|null $calendarEvent
     *
     * @return Update
     */
    public function setCalendarEvent(?CalendarEvent $calendarEvent): Update
    {
        $this->calendarEvent = $calendarEvent;

        return $this;
    }

    /**
     * @return array<string, array<string, bool|int|string|array<int, array<string, int|null>>|null>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->calendarEvent instanceof CalendarEvent) {
            $data['cal_event'] = $this->calendarEvent->jsonSerialize();
        }

        return $data;
    }
}
