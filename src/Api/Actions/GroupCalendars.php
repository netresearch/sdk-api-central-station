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
use Netresearch\Sdk\CentralStation\Model\Container\Collection\GroupCalendarContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\GroupCalendarContainer;
use Netresearch\Sdk\CentralStation\Model\GroupCalendar;
use Netresearch\Sdk\CentralStation\Request\GroupCalendars\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\GroupCalendars\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * The /group_calendars endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/group_calendars
 *     GET    https://<BASE-URL>/api/group_calendars/<GROUP-CALENDAR-ID>
 *     POST   https://<BASE-URL>/api/group_calendars
 *     PUT    https://<BASE-URL>/api/group_calendars/<GROUP-CALENDAR-ID>
 *     DELETE https://<BASE-URL>/api/group_calendars/<GROUP-CALENDAR-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 *
 * @extends AbstractApiEndpoint<GroupCalendarContainer, GroupCalendarContainerCollection>
 */
class GroupCalendars extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'group_calendars';

    /**
     * Returns a list of all group calendars in an account.
     *
     * GET https://<BASE-URL>/api/group_calendars
     *
     * @param IndexRequest $request The index request instance
     *
     * @return GroupCalendarContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): GroupCalendarContainerCollection
    {
        return $this->findAllEntities(
            $request,
            GroupCalendarContainer::class,
            GroupCalendarContainerCollection::class
        );
    }

    /**
     * Returns a group calendar. The route must contain the ID of the group calendar to be processed.
     *
     * GET https://<BASE-URL>/api/group_calendars/<GROUP-CALENDAR-ID>
     *
     * @param ShowRequest $request The show request instance
     *
     * @return GroupCalendar|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(ShowRequest $request): ?GroupCalendar
    {
        $result = $this->findEntity(
            $request,
            GroupCalendarContainer::class
        );

        return ($result instanceof GroupCalendarContainer) ? ($result->groupCalendar ?? null) : null;
    }

    /**
     * Creates a new group calendar and returns it.
     *
     * POST https://<BASE-URL>/api/group_calendars
     *
     * @param RequestInterface $request The create request instance
     *
     * @return never
     *
     * @throws DetailedServiceException
     */
    public function create(RequestInterface $request): never
    {
        throw new DetailedServiceException('Create not implemented for group calendars');
    }

    /**
     * Updates an existing group calendar.
     *
     * PUT https://<BASE-URL>/api/group_calendars/<GROUP-CALENDAR-ID>
     *
     * @param RequestInterface $request The update request instance
     *
     * @return bool
     *
     * @throws DetailedServiceException
     */
    public function update(RequestInterface $request): bool
    {
        throw new DetailedServiceException('Update not implemented for group calendars');
    }
}
