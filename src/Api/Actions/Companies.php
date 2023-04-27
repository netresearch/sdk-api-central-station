<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions;

use Netresearch\Sdk\CentralStation\Api\Actions\Companies\Addresses;
use Netresearch\Sdk\CentralStation\Api\Actions\Companies\CustomFields;
use Netresearch\Sdk\CentralStation\Api\Actions\Companies\Tags;
use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\CompanyContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\CompanyContainer;
use Netresearch\Sdk\CentralStation\Model\Company;
use Netresearch\Sdk\CentralStation\Model\Stats;
use Netresearch\Sdk\CentralStation\Request\Companies\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\Companies\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\Companies\Search as SearchRequest;
use Netresearch\Sdk\CentralStation\Request\Companies\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\Request\Companies\Stats as StatsRequest;

/**
 * The /companies endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/companies
 *     GET    https://<BASE-URL>/api/companies/<COMPANY-ID>
 *     POST   https://<BASE-URL>/api/companies
 *     PUT    https://<BASE-URL>/api/companies/<COMPANY-ID>
 *     DELETE https://<BASE-URL>/api/companies/<COMPANY-ID>
 *     GET    https://<BASE-URL>/api/companies/search
 *     GET    https://<BASE-URL>/api/companies/stats
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class Companies extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'companies';

    /**
     * Instance of the "addrs" API for implementing lazy loading.
     */
    private ?Addresses $addressesApi = null;

    /**
     * Instance of the "custom_fields" API for implementing lazy loading.
     */
    private ?CustomFields $customFieldsApi = null;

    /**
     * Instance of the "tags" API for implementing lazy loading.
     */
    private ?Tags $tagsApi = null;

    /**
     * Returns the "addrs" API used to process addresses related to a specific company.
     *
     * @param null|int $addressId A valid address ID
     *
     * @return Companies\Addresses
     */
    public function addresses(int $addressId = null): Addresses
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . Addresses::PATH);

        // Add address ID if available
        if ($addressId) {
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
     * Returns the "custom_fields" API used to process custom fields related to a specific company.
     *
     * @param null|int $customFieldId A valid custom field ID
     *
     * @return Companies\CustomFields
     */
    public function customFields(int $customFieldId = null): CustomFields
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . CustomFields::PATH);

        // Add custom field ID if available
        if ($customFieldId) {
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
     * Returns the "tags" API used to process tags related to a specific company.
     *
     * @param null|int $tagId A valid tag ID
     *
     * @return Companies\Tags
     */
    public function tags(int $tagId = null): Tags
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . Tags::PATH);

        // Add tag ID if available
        if ($tagId) {
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
     * Returns a list of all companies in an account.
     *
     * GET https://<BASE-URL>/api/companies
     *
     * @param IndexRequest $request The index request instance
     *
     * @return CompanyContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): CompanyContainerCollection
    {
        return $this->findAllEntities(
            $request,
            CompanyContainer::class,
            CompanyContainerCollection::class
        );
    }

    /**
     * Returns a single company. The route must contain the ID of the company to be processed.
     *
     * GET https://<BASE-URL>/api/companies/<COMPANY-ID>
     *
     * @param ShowRequest $request The show request instance
     *
     * @return null|Company
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(ShowRequest $request): ?Company
    {
        $result = $this->findEntity(
            $request,
            CompanyContainer::class
        );

        return $result ? ($result->company ?? null) : null;
    }

    /**
     * Creates a new company and returns it. To create a new company, the transfer of the
     * surname is mandatory. If the entry could not be created because the account no longer has sufficient
     * storage space for contacts, the HTTP error 507 Insufficient Storage is thrown.
     *
     * POST https://<BASE-URL>/api/companies
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Company
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Company
    {
        $result = $this->createNewEntity(
            $request,
            CompanyContainer::class
        );

        return $result ? ($result->company ?? null) : null;
    }

    /**
     * To search for one or more companies, the parameters name, first_name, phone or email can be passed.
     * If one or more hits are found, the return is in the same form as with the index function. If no matches
     * are found we return an empty array.
     *
     * GET https://<BASE-URL>/api/companies/search
     *
     * @param SearchRequest $request The search request instance
     *
     * @return CompanyContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function search(SearchRequest $request): CompanyContainerCollection
    {
        $this->urlBuilder
            ->addPath('/search');

        return $this->findAllEntities(
            $request,
            CompanyContainer::class,
            CompanyContainerCollection::class
        );
    }

    /**
     * The stats can be used to query pure count or sum calculations for all or filtered companys. The companies
     * can be filtered like the index action, i.e. by tags or any fields.
     *
     * GET https://<BASE-URL>/api/companies/stats
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
}
