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
use Netresearch\Sdk\CentralStation\Collection\PeopleCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Model\People\Person;
use Netresearch\Sdk\CentralStation\Request\People\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\People\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\People\Merge as MergeRequest;
use Netresearch\Sdk\CentralStation\Request\People\Search as SearchRequest;
use Netresearch\Sdk\CentralStation\Request\People\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\Request\People\Stats as StatsRequest;

/**
 * The /people endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/people
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>
 *     POST   https://<BASE-URL>/api/people
 *     PUT    https://<BASE-URL>/api/people/<PERSON-ID>
 *     DELETE https://<BASE-URL>/api/people/<PERSON-ID>
 *     GET    https://<BASE-URL>/api/people/search
 *     GET    https://<BASE-URL>/api/people/stats
 *     POST   https://<BASE-URL>/api/people/merge
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 *
 * @extends AbstractApiEndpoint<Model\People, PeopleCollection>
 * @extends AbstractApiEndpoint<Model\Stats, PeopleCollection>
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
     * Instance of the "tags" API for implementing lazy loading.
     *
     * @var null|People\Tags
     */
    private $tagsApi;

    /**
     * Instance of the "protocols" API for implementing lazy loading.
     *
     * @var null|People\Protocols
     */
    private $protocolsApi;

    /**
     * Instance of the "addrs" API for implementing lazy loading.
     *
     * @var null|People\Addresses
     */
    private $addressesApi;

    /**
     * Returns the "tags" API used to process tags related to a specific person.
     *
     * @param null|int $tagId A valid tag ID
     *
     * @return People\Tags
     */
    public function tags(int $tagId = null): People\Tags
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . People\Tags::PATH);

        // Add tag ID if available
        if ($tagId) {
            $this->urlBuilder
                ->addPath('/' . $tagId);
        }

        if (!$this->tagsApi) {
            $this->tagsApi = new People\Tags(
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
     * Returns the "protocols" API used to process protocols related to a specific person.
     *
     * @param null|int $protocolId A valid protocol ID
     *
     * @return People\Protocols
     */
    public function protocols(int $protocolId = null): People\Protocols
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . People\Protocols::PATH);

        // Add protocol ID if available
        if ($protocolId) {
            $this->urlBuilder
                ->addPath('/' . $protocolId);
        }

        if (!$this->protocolsApi) {
            $this->protocolsApi = new People\Protocols(
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
     * Returns the "addrs" API used to process addresses related to a specific person.
     *
     * @param null|int $addressId A valid address ID
     *
     * @return People\Addresses
     */
    public function addresses(int $addressId = null): People\Addresses
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . People\Addresses::PATH);

        // Add address ID if available
        if ($addressId) {
            $this->urlBuilder
                ->addPath('/' . $addressId);
        }

        if (!$this->addressesApi) {
            $this->addressesApi = new People\Addresses(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->addressesApi;
    }

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
     */
    public function index(IndexRequest $request): PeopleCollection
    {
        return $this->findAllEntities(
            $request,
            Model\People::class,
            PeopleCollection::class
        );
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
     */
    public function show(ShowRequest $request): ?Person
    {
        $result = $this->findEntity(
            $request,
            Model\People::class
        );

        return $result ? ($result->person ?? null) : null;
    }

    /**
     * Creates a new person and returns it. To create a new person, the transfer of the
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
     */
    public function create(CreateRequest $request): ?Person
    {
        $result = $this->createNewEntity(
            $request,
            Model\People::class
        );

        return $result ? ($result->person ?? null) : null;
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
     */
    public function search(SearchRequest $request): PeopleCollection
    {
        $this->urlBuilder
            ->addPath('/search');

        return $this->findAllEntities(
            $request,
            Model\People::class,
            PeopleCollection::class
        );
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
     */
    public function stats(StatsRequest $request): int
    {
        $this->urlBuilder
            ->addPath('/stats');

        $result = $this->findEntity(
            $request,
            Model\Stats::class
        );

        return $result->totalEntries ?? 0;
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
     */
    public function merge(MergeRequest $request): bool
    {
        $requestClosure = function () use ($request): bool {
            $this->urlBuilder
                ->addPath('/merge');

            return $this->httpPost($request)->getStatusCode() === 200;
        };

        return (bool) $this->execute($requestClosure);
    }
}
