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
 * A "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Create implements RequestInterface
{
    /**
     * @var CalendarEvent
     */
    private $calendarEvent;

    /**
     * Constructor.
     *
     * @param CalendarEvent $calendarEvent
     */
    public function __construct(CalendarEvent $calendarEvent)
    {
        $this->calendarEvent = $calendarEvent;
    }

    /**
     * @return array<string, array<string, null|bool|int|string|array<int, array<string, null|int>>>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['cal_event'] = $this->calendarEvent->jsonSerialize();

        return $data;
    }
}
