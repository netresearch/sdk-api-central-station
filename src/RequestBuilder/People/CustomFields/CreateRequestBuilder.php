<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People\CustomFields;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\CustomField;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\CustomFields\CreateValidator;

/**
 * The request builder to create a valid "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class CreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the content of the custom field.
     *
     * @param string $content The content of the custom field
     *
     * @return CreateRequestBuilder
     */
    public function setContent(string $content): CreateRequestBuilder
    {
        $this->data['content'] = $content;

        return $this;
    }

    /**
     * Sets the ID of the underlying custom fields type.
     *
     * @param int $customFieldsTypeId The ID of the underlying custom fields type
     *
     * @return CreateRequestBuilder
     */
    public function setCustomFieldsTypeId(int $customFieldsTypeId): CreateRequestBuilder
    {
        $this->data['customFieldsTypeId'] = $customFieldsTypeId;

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return CreateRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): CreateRequest
    {
        // Validate the input
        CreateValidator::validate($this->data);

        $customField = new CustomField();
        $customField
            ->setContent($this->data['content'])
            ->setCustomFieldsTypeId($this->data['customFieldsTypeId']);

        // Assign values to request
        $request = new CreateRequest($customField);

        $this->data = [];

        return $request;
    }
}
