<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation;

use Netresearch\Sdk\CentralStation\Api\Actions\CalendarEvents;
use Netresearch\Sdk\CentralStation\Api\Actions\Companies;
use Netresearch\Sdk\CentralStation\Api\Actions\CustomFieldsTypes;
use Netresearch\Sdk\CentralStation\Api\Actions\GroupCalendars;
use Netresearch\Sdk\CentralStation\Api\Actions\People;
use Netresearch\Sdk\CentralStation\Api\Actions\Protocols;
use Netresearch\Sdk\CentralStation\Api\Actions\Tags;
use Netresearch\Sdk\CentralStation\Serializer\JsonSerializer;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Provides methods to get classes for each type of API call.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Api
{
    /**
     * Instance of the "people" API for implementing lazy loading.
     *
     * @var null|People
     */
    private $peopleApi;

    /**
     * Instance of the "companies" API for implementing lazy loading.
     *
     * @var null|Companies
     */
    private $companiesApi;

    /**
     * Instance of the "tags" API for implementing lazy loading.
     *
     * @var null|Tags
     */
    private $tagsApi;

    /**
     * Instance of the "protocols" API for implementing lazy loading.
     *
     * @var null|Protocols
     */
    private $protocolsApi;

    /**
     * Instance of the "custom_fields_types" API for implementing lazy loading.
     *
     * @var null|CustomFieldsTypes
     */
    private $customFieldsTypesApi;

    /**
     * Instance of the "group_calendars" API for implementing lazy loading.
     *
     * @var null|GroupCalendars
     */
    private $groupCalendarsApi;

    /**
     * Instance of the "cal_events" API for implementing lazy loading.
     *
     * @var null|CalendarEvents
     */
    private $calendarEventsApi;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @var JsonSerializer
     */
    private $serializer;

    /**
     * @var UrlBuilder
     */
    private $urlBuilder;

    /**
     * Api constructor.
     *
     * @param ClientInterface         $client
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param JsonSerializer          $jsonSerializer
     * @param UrlBuilder              $urlBuilder
     */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        JsonSerializer $jsonSerializer,
        UrlBuilder $urlBuilder
    ) {
        $this->client         = $client;
        $this->requestFactory = $requestFactory;
        $this->streamFactory  = $streamFactory;
        $this->serializer     = $jsonSerializer;
        $this->urlBuilder     = $urlBuilder;
    }

    /**
     * Returns the "people" API by lazy loading.
     *
     * @param null|int $personId A valid person ID
     *
     * @return People
     */
    public function people(int $personId = null): People
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . People::PATH);

        // Add person ID if available
        if ($personId) {
            $this->urlBuilder
                ->addPath('/' . $personId);
        }

        if (!$this->peopleApi) {
            $this->peopleApi = new People(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->peopleApi;
    }

    /**
     * Returns the "companies" API by lazy loading.
     *
     * @param null|int $companyId A valid company ID
     *
     * @return Companies
     */
    public function companies(int $companyId = null): Companies
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . Companies::PATH);

        // Add company ID if available
        if ($companyId) {
            $this->urlBuilder
                ->addPath('/' . $companyId);
        }

        if (!$this->companiesApi) {
            $this->companiesApi = new Companies(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->companiesApi;
    }

    /**
     * Returns the "tags" API by lazy loading.
     *
     * @param null|int $tagId A valid tag ID
     *
     * @return Tags
     */
    public function tags(int $tagId = null): Tags
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . Tags::PATH);

        // Add tag ID if available
        if ($tagId) {
            $this->urlBuilder
                ->addPath('/' . $tagId);
        }

        if (!$this->tagsApi) {
            $this->tagsApi = new Tags(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->tagsApi;
    }

    /**
     * Returns the "protocols" API by lazy loading.
     *
     * @param null|int $protocolId A valid protocol ID
     *
     * @return Protocols
     */
    public function protocols(int $protocolId = null): Protocols
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . Protocols::PATH);

        // Add protocol ID if available
        if ($protocolId) {
            $this->urlBuilder
                ->addPath('/' . $protocolId);
        }

        if (!$this->protocolsApi) {
            $this->protocolsApi = new Protocols(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->protocolsApi;
    }

    /**
     * Returns the "customFieldsTypes" API by lazy loading.
     *
     * @param null|int $customFieldsTypeId A valid custom fields type ID
     *
     * @return CustomFieldsTypes
     */
    public function customFieldsTypes(int $customFieldsTypeId = null): CustomFieldsTypes
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . CustomFieldsTypes::PATH);

        // Add custom field type ID if available
        if ($customFieldsTypeId) {
            $this->urlBuilder
                ->addPath('/' . $customFieldsTypeId);
        }

        if (!$this->customFieldsTypesApi) {
            $this->customFieldsTypesApi = new CustomFieldsTypes(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->customFieldsTypesApi;
    }

    /**
     * Returns the "groupCalendars" API by lazy loading.
     *
     * @param null|string $groupCalendarId A valid group calendar ID
     *
     * @return GroupCalendars
     */
    public function groupCalendars(string $groupCalendarId = null): GroupCalendars
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . GroupCalendars::PATH);

        // Add group calendar type ID if available
        if ($groupCalendarId) {
            $this->urlBuilder
                ->addPath('/' . $groupCalendarId);
        }

        if (!$this->groupCalendarsApi) {
            $this->groupCalendarsApi = new GroupCalendars(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->groupCalendarsApi;
    }

    /**
     * Returns the "calendarEvents" API by lazy loading.
     *
     * @param null|string $calendarEventId A valid calendar event ID
     *
     * @return CalendarEvents
     */
    public function calendarEvents(string $calendarEventId = null): CalendarEvents
    {
        $this->urlBuilder
            ->reset()
            ->addPath('/' . CalendarEvents::PATH);

        // Add calendar event type ID if available
        if ($calendarEventId) {
            $this->urlBuilder
                ->addPath('/' . $calendarEventId);
        }

        if (!$this->calendarEventsApi) {
            $this->calendarEventsApi = new CalendarEvents(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->calendarEventsApi;
    }
}
