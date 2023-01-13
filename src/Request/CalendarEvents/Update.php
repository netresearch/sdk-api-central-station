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
     * @var null|CalendarEvent
     */
    private $calendarEvent;

    /**
     * @param null|CalendarEvent $calendarEvent
     *
     * @return Update
     */
    public function setCalendarEvent(?CalendarEvent $calendarEvent): Update
    {
        $this->calendarEvent = $calendarEvent;
        return $this;
    }

    /**
     * @return array<string, array<string, null|int|bool|string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->calendarEvent) {
            $data['cal_event'] = $this->calendarEvent->jsonSerialize();
        }

        return $data;
    }
}
