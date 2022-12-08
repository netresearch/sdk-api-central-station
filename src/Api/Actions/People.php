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
     * Returns a list of all people in an account.
     *
     * GET https://<BASE-URL>/api/people
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
     * Returns a single person. The route must contain the ID of the person to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>
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
    public function show(ShowRequest $request): ?Person
    {
        $this->urlBuilder
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var null|\Netresearch\Sdk\CentralStation\Model\People $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class
        );

        return $result ? ($result->person ?? null) : null;
    }

    /**
     * Creates a new person and returns the newly created element. To create a new person, the transfer of the
     * surname is mandatory. If the entry could not be created because the account no longer has sufficient
     * storage space for contacts, the HTTP error 507 Insufficient Storage is thrown.
     *
     * POST https://<BASE-URL>/api/people
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

        return $result ? ($result->person ?? null) : null;
    }

    /**
     * Updates an existing person. The route must contain the ID of the element to be processed.
     *
     * The update works in the same way as the "create" action. The route must contain the ID of the
     * element to be processed. Returns TRUE on success, FALSE otherwise.
     *
     * PUT https://<BASE-URL>/api/people/<PERSON-ID>
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
     * Deletes an existing person. Returns TRUE on success, FALSE otherwise.
     *
     * DELETE https://<BASE-URL>/api/people/<PERSON-ID>
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
     * GET https://<BASE-URL>/api/people/search
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
     * GET https://<BASE-URL>/api/people/stats
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
     * After the merge request, the merged person records no longer exists.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/merge
     *
     * @notice Merging takes some time. An index/show request should not be made directly after a merge,
     *         since the returned data may be invalid or incorrect. As a guide, during API testing, the merged
     *         data was mostly available within 5 seconds at most.
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
