<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions;

use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\CalendarEvent;
use Netresearch\Sdk\CentralStation\Model\Container\CalendarEventContainer;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\CalendarEventContainerCollection;
use Netresearch\Sdk\CentralStation\Request\CalendarEvents\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\CalendarEvents\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\CalendarEvents\Show as ShowRequest;

/**
 * The /cal_events endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/cal_events
 *     GET    https://<BASE-URL>/api/cal_events/<CALENDAR-EVENT-ID>
 *     POST   https://<BASE-URL>/api/cal_events
 *     PUT    https://<BASE-URL>/api/cal_events/<CALENDAR-EVENT-ID>
 *     DELETE https://<BASE-URL>/api/cal_events/<CALENDAR-EVENT-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 *
 * @extends AbstractApiEndpoint<CalendarEventContainer, CalendarEventContainerCollection>
 */
class CalendarEvents extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'cal_events';

    /**
     * Returns a list of all calendar events in an account.
     *
     * GET https://<BASE-URL>/api/cal_events
     *
     * @param IndexRequest $request The index request instance
     *
     * @return CalendarEventContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): CalendarEventContainerCollection
    {
        return $this->findAllEntities(
            $request,
            CalendarEventContainer::class,
            CalendarEventContainerCollection::class
        );
    }

    /**
     * Returns a single calendar events. The route must contain the ID of the calendar event to be processed.
     *
     * GET https://<BASE-URL>/api/cal_events/<CALENDAR-EVENT-ID>
     *
     * @param ShowRequest $request The show request instance
     *
     * @return CalendarEvent|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(ShowRequest $request): ?CalendarEvent
    {
        $result = $this->findEntity(
            $request,
            CalendarEventContainer::class
        );

        return ($result instanceof CalendarEventContainer) ? ($result->calendarEvent ?? null) : null;
    }

    /**
     * Creates a new calendar event and returns it.
     *
     * POST https://<BASE-URL>/api/cal_events
     *
     * @param CreateRequest $request The create request instance
     *
     * @return CalendarEvent|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?CalendarEvent
    {
        $result = $this->createNewEntity(
            $request,
            CalendarEventContainer::class
        );

        return ($result instanceof CalendarEventContainer) ? ($result->calendarEvent ?? null) : null;
    }
}
