<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions\People;

use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Collection\CustomFieldsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Model\CustomFields\CustomField;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Show as ShowRequest;

/**
 * The /custom_fields endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields/<CUSTOM-FIELDS-ID>
 *     POST   https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields
 *     PUT    https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields/<CUSTOM-FIELDS-ID>
 *     DELETE https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields/<CUSTOM-FIELDS-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class CustomFields extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'custom_fields';

    /**
     * Returns a list of all custom field in an account.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields
     *
     * @param IndexRequest $request The index request instance
     *
     * @return CustomFieldsCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): CustomFieldsCollection
    {
        return $this->findAllEntities(
            $request,
            Model\CustomFields::class,
            CustomFieldsCollection::class
        );
    }

    /**
     * Returns a single custom field. Requires a valid custom field type ID for the account.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields/<CUSTOM-FIELDS-ID>
     *
     * @param ShowRequest $request The show request instance
     *
     * @return null|CustomField
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(ShowRequest $request): ?CustomField
    {
        $result = $this->findEntity(
            $request,
            Model\CustomFields::class
        );

        return $result ? ($result->customField ?? null) : null;
    }

    /**
     * Creates a new custom field and returns it.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/custom_fields
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|CustomField
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?CustomField
    {
        $result = $this->createNewEntity(
            $request,
            Model\CustomFields::class
        );

        return $result ? ($result->customField ?? null) : null;
    }
}
