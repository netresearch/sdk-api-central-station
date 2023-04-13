<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\CustomFieldsTypes;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsType;
use Netresearch\Sdk\CentralStation\Request\CustomFieldsTypes\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\CustomFieldsTypes\UpdateValidator;
use function in_array;

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
     * Sets the position of the custom field to display in the CRM backend.
     *
     * @param int $position The position
     *
     * @return UpdateRequestBuilder
     */
    public function setPosition(int $position): UpdateRequestBuilder
    {
        $this->data['position'] = $position;
        return $this;
    }

    /**
     * Sets the name of the custom field type.
     *
     * @param string $name The name of the custom field type
     *
     * @return UpdateRequestBuilder
     */
    public function setName(string $name): UpdateRequestBuilder
    {
        $this->data['name'] = $name;
        return $this;
    }

    /**
     * Sets the category.
     *
     * @param string $category The category (one of Constants::CUSTOM_FIELDS_TYPE_CATEGORY_*).
     *
     * @return UpdateRequestBuilder
     */
    public function setCategory(string $category): UpdateRequestBuilder
    {
        $this->data['category'] = $category;
        return $this;
    }

    /**
     * Sets the field type.
     *
     * @param string $type The type of the custom field (one of Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_*).
     *
     * @return UpdateRequestBuilder
     */
    public function setType(string $type): UpdateRequestBuilder
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * Adds an option.
     *
     * @param string $option The option value
     *
     * @return UpdateRequestBuilder
     */
    public function addOption(string $option): UpdateRequestBuilder
    {
        if (!isset($this->data['options'])) {
            $this->data['options'] = [];
        }

        if (!in_array($option, $this->data['options'], true)) {
            $this->data['options'][] = $option;
        }

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

        $customFieldsType = new CustomFieldsType();

        if (isset($this->data['name'])) {
            $customFieldsType->setName($this->data['name']);
        }

        if (isset($this->data['category'])) {
            $customFieldsType->setCategory($this->data['category']);
        }

        if (isset($this->data['type'])) {
            $customFieldsType->setType($this->data['type']);
        }

        if (isset($this->data['position'])) {
            $customFieldsType->setPosition($this->data['position']);
        }

        if (isset($this->data['options'])) {
            $customFieldsType->setOptions(...$this->data['options']);
        }

        // Assign values to request
        $request = new UpdateRequest();
        $request->setCustomFieldsType($customFieldsType);

        $this->data = [];

        return $request;
    }
}
