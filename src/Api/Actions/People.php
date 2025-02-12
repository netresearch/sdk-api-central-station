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
use Netresearch\Sdk\CentralStation\Api\Actions\People\Addresses;
use Netresearch\Sdk\CentralStation\Api\Actions\People\CustomFields;
use Netresearch\Sdk\CentralStation\Api\Actions\People\Protocols;
use Netresearch\Sdk\CentralStation\Api\Actions\People\Tags;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\PersonContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\PersonContainer;
use Netresearch\Sdk\CentralStation\Model\Person;
use Netresearch\Sdk\CentralStation\Model\Stats;
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
 *
 * @api
 */
class People extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'people';

    /**
     * Instance of the "addrs" API for implementing lazy loading.
     *
     * @var Addresses|null
     */
    private ?Addresses $addressesApi = null;

    /**
     * Instance of the "custom_fields" API for implementing lazy loading.
     *
     * @var CustomFields|null
     */
    private ?CustomFields $customFieldsApi = null;

    /**
     * Instance of the "protocols" API for implementing lazy loading.
     *
     * @var Protocols|null
     */
    private ?Protocols $protocolsApi = null;

    /**
     * Instance of the "tags" API for implementing lazy loading.
     *
     * @var Tags|null
     */
    private ?Tags $tagsApi = null;

    /**
     * Returns the "addrs" API used to process addresses related to a specific person.
     *
     * @param int|null $addressId A valid address ID
     *
     * @return Addresses
     */
    public function addresses(?int $addressId = null): Addresses
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . Addresses::PATH);

        // Add address ID if available
        if (($addressId !== null) && ($addressId !== 0)) {
            $this->urlBuilder
                ->addPath('/' . $addressId);
        }

        if (!($this->addressesApi instanceof Addresses)) {
            $this->addressesApi = new Addresses(
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
     * Returns the "custom_fields" API used to process custom fields related to a specific person.
     *
     * @param int|null $customFieldId A valid custom field ID
     *
     * @return CustomFields
     */
    public function customFields(?int $customFieldId = null): CustomFields
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . CustomFields::PATH);

        // Add custom field ID if available
        if (($customFieldId !== null) && ($customFieldId !== 0)) {
            $this->urlBuilder
                ->addPath('/' . $customFieldId);
        }

        if (!($this->customFieldsApi instanceof CustomFields)) {
            $this->customFieldsApi = new CustomFields(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->customFieldsApi;
    }

    /**
     * Returns the "protocols" API used to process protocols related to a specific person.
     *
     * @param int|null $protocolId A valid protocol ID
     *
     * @return Protocols
     */
    public function protocols(?int $protocolId = null): Protocols
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . Protocols::PATH);

        // Add protocol ID if available
        if (($protocolId !== null) && ($protocolId !== 0)) {
            $this->urlBuilder
                ->addPath('/' . $protocolId);
        }

        if (!($this->protocolsApi instanceof Protocols)) {
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
     * Returns the "tags" API used to process tags related to a specific person.
     *
     * @param int|null $tagId A valid tag ID
     *
     * @return Tags
     */
    public function tags(?int $tagId = null): Tags
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . Tags::PATH);

        // Add tag ID if available
        if (($tagId !== null) && ($tagId !== 0)) {
            $this->urlBuilder
                ->addPath('/' . $tagId);
        }

        if (!($this->tagsApi instanceof Tags)) {
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
     * Returns a list of all people in an account.
     *
     * GET https://<BASE-URL>/api/people
     *
     * @param IndexRequest $request The index request instance
     *
     * @return PersonContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): PersonContainerCollection
    {
        return $this->findAllEntities(
            $request,
            PersonContainer::class,
            PersonContainerCollection::class
        );
    }

    /**
     * Returns a single person. The route must contain the ID of the person to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>
     *
     * @param ShowRequest $request The show request instance
     *
     * @return Person|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(ShowRequest $request): ?Person
    {
        $result = $this->findEntity(
            $request,
            PersonContainer::class
        );

        return ($result instanceof PersonContainer) ? ($result->person ?? null) : null;
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
     * @return Person|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Person
    {
        $result = $this->createNewEntity(
            $request,
            PersonContainer::class
        );

        return ($result instanceof PersonContainer) ? ($result->person ?? null) : null;
    }

    /**
     * To search for one or more people, the parameter name, first_name, phone or email can be passed.
     * If one or more hits are found, the return is in the same form as with the index function. If no matches
     * are found we return an empty array.
     *
     * GET https://<BASE-URL>/api/people/search
     *
     * @param SearchRequest $request The search request instance
     *
     * @return PersonContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function search(SearchRequest $request): PersonContainerCollection
    {
        $this->urlBuilder
            ->addPath('/search');

        return $this->findAllEntities(
            $request,
            PersonContainer::class,
            PersonContainerCollection::class
        );
    }

    /**
     * The stats can be used to query pure count or sum calculations for all or filtered persons. The people
     * can be filtered like the index action, i.e., by tags or any fields.
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
            Stats::class
        );

        return $result->totalEntries ?? 0;
    }

    /**
     * Several people can be brought together using the merge function. The person IDs passed as looser_ids
     * is merged with the person passed as id. The logic is similar to a merger via the CentralStationCRM interface.
     * After the merge request, the merged person records no longer exists.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/merge
     *
     * @notice Merging takes some time. An index/show request should not be made directly after a merge since
     *         the returned data may be invalid or incorrect. As a guide, during API testing, the merged
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

            // Each API endpoint returns different HTTP status codes (200, 204, ...),
            // so we need to check if it's at least one in the 200s range.
            return $this->httpPost($request)->getStatusCode() < 300;
        };

        return (bool) $this->execute($requestClosure);
    }
}
