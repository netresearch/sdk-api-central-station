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
use Netresearch\Sdk\CentralStation\Collection\CustomFieldsTypeCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Model\CustomFieldsType\CustomFieldType;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsTypes\Create as CreateRequest;

/**
 * The /custom_fields_types endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/custom_fields_types
 *     GET    https://<BASE-URL>/api/custom_fields_types/<CUSTOM-FIELDS-TYPE-ID>
 *     POST   https://<BASE-URL>/api/custom_fields_types
 *     PUT    https://<BASE-URL>/api/custom_fields_types/<CUSTOM-FIELDS-TYPE-ID>
 *     DELETE https://<BASE-URL>/api/custom_fields_types/<CUSTOM-FIELDS-TYPE-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 *
 * @extends AbstractApiEndpoint<Model\CustomFieldsType, CustomFieldsTypeCollection>
 */
class CustomFieldsTypes extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'custom_fields_types';

    /**
     * Returns a list of all custom field types in an account.
     *
     * GET https://<BASE-URL>/api/custom_fields_types
     *
     * @return CustomFieldsTypeCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(): CustomFieldsTypeCollection
    {
        return $this->findAllEntities(
            null,
            Model\CustomFieldsType::class,
            CustomFieldsTypeCollection::class
        );
    }

    /**
     * Returns a single custom field type. Requires a valid custom field type ID for the account.
     *
     * GET https://<BASE-URL>/api/custom_fields_types/<CUSTOM-FIELDS-TYPE-ID>
     *
     * @return null|CustomFieldType
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?CustomFieldType
    {
        $result = $this->findEntity(
            null,
            Model\CustomFieldsType::class
        );

        return $result ? ($result->customFieldsType ?? null) : null;
    }

    /**
     * Creates a new custom field type and returns it.
     *
     * POST https://<BASE-URL>/api/custom_fields_types
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|CustomFieldType
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?CustomFieldType
    {
        $result = $this->createNewEntity(
            $request,
            Model\CustomFieldsType::class
        );

        return $result ? ($result->customFieldsType ?? null) : null;
    }
}
