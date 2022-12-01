<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions;

use JsonException;
use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Collection\PeopleCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\People\Person;
use Netresearch\Sdk\CentralStation\Model\Stats;
use Netresearch\Sdk\CentralStation\Request\People\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\People\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\People\Merge as MergeRequest;
use Netresearch\Sdk\CentralStation\Request\People\Search as SearchRequest;
use Netresearch\Sdk\CentralStation\Request\People\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\Request\People\Stats as StatsRequest;
use Netresearch\Sdk\CentralStation\Request\People\Update as UpdateRequest;

/**
 * The /people endpoint.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class People extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'people';

    /**
     * The index action can be used to query a list of all people in an account.
     *
     * https://<BASE-URL>/api/people.json
     *
     * @param IndexRequest $request The index request instance
     *
     * @return PeopleCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function index(IndexRequest $request): PeopleCollection
    {
        $this->urlBuilder
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var PeopleCollection $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class,
            PeopleCollection::class
        );

        return $result;
    }

    /**
     * A single person can be loaded with the show action. The prerequisite for this is
     * a valid personal ID for the account.
     *
     * https://<BASE-URL>/api/people/<PERSON-ID>.json
     *
     * @param ShowRequest $request The show request instance
     *
     * @return null|Person
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function show(
        ShowRequest $request
    ): ?Person {
        $this->urlBuilder
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var null|\Netresearch\Sdk\CentralStation\Model\People $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class
        );

        return $result->person ?? null;
    }

    /**
     * This method creates a new person. In the positive case, the system returns
     * the new person. To create a new person, the transfer of the surname is mandatory. If the entry
     * could not be created because the account no longer has sufficient storage space for contacts,
     * we return a 507 Insufficient Storage.
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Person
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function create(CreateRequest $request): ?Person
    {
        $response = $this->httpPost($request);

        /** @var null|\Netresearch\Sdk\CentralStation\Model\People $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class
        );

        return $result->person ?? null;
    }

    /**
     * The update works in the same way as the "create" action. The route must contain the ID of the
     * element to be processed. Returns TRUE on success, FALSE otherwise.
     *
     * @param UpdateRequest $request The update request instance
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function update(UpdateRequest $request): bool
    {
        return $this->httpPut($request)->getStatusCode() === 200;
    }

    /**
     * This method is used to delete an element. Returns TRUE on success, FALSE otherwise.
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function delete(): bool
    {
        return $this->httpDelete()->getStatusCode() === 200;
    }

    /**
     * To search for one or more people, the parameters name, first_name, phone or email can be passed.
     * If one or more hits are found, the return is in the same form as with the index function. If no matches
     * are found we return an empty array.
     *
     * https://<BASE-URL>/api/people/search.json
     *
     * @param SearchRequest $request The search request instance
     *
     * @return PeopleCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function search(SearchRequest $request): PeopleCollection
    {
        $this->urlBuilder
            ->addPath('/search')
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var PeopleCollection $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class,
            PeopleCollection::class
        );

        return $result;
    }

    /**
     * The stats can be used to query pure count or sum calculations for all or filtered persons. The people
     * can be filtered like the index action, i.e. by tags or any fields.
     *
     * https://<BASE-URL>/api/people/stats.json
     *
     * @param StatsRequest $request The stats request instance
     *
     * @return int
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function stats(StatsRequest $request): int
    {
        $this->urlBuilder
            ->addPath('/stats')
            ->setParams($request->jsonSerialize());

        /** @var Stats $result */
        $result = $this->serializer->decode(
            (string) $this->httpGet()->getBody(),
            Stats::class
        );

        return $result->totalEntries;
    }

    /**
     * Several people can be brought together using the merge function. The person IDs passed as looser_ids
     * are merged with the person passed as id. The logic is similar to a merger via the CentralStationCRM interface.
     *
     * @param MergeRequest $request The merge request instance
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function merge(MergeRequest $request): bool
    {
        $this->urlBuilder
            ->addPath('/merge');

        return $this->httpPost($request)->getStatusCode() === 200;
    }
}
