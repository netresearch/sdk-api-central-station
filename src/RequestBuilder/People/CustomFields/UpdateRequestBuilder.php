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
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\CustomFields\UpdateValidator;

/**
 * The request builder to create a valid "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class UpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the content of the custom field.
     *
     * @param string $content The content of the custom field
     *
     * @return UpdateRequestBuilder
     */
    public function setContent(string $content): UpdateRequestBuilder
    {
        $this->data['content'] = $content;
        return $this;
    }

    /**
     * Sets the ID of the underlying custom fields type.
     *
     * @param int $customFieldsTypeId The ID of the underlying custom fields type
     *
     * @return UpdateRequestBuilder
     */
    public function setCustomFieldsTypeId(int $customFieldsTypeId): UpdateRequestBuilder
    {
        $this->data['customFieldsTypeId'] = $customFieldsTypeId;
        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return UpdateRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): UpdateRequest
    {
        // Validate the input
        UpdateValidator::validate($this->data);

        $customField = new CustomField();

        if (isset($this->data['content'])) {
            $customField->setContent($this->data['content']);
        }

        if (isset($this->data['customFieldsTypeId'])) {
            $customField->setCustomFieldsTypeId($this->data['customFieldsTypeId']);
        }

        // Assign values to request
        $request = new UpdateRequest();
        $request->setCustomField($customField);

        $this->data = [];

        return $request;
    }
}
