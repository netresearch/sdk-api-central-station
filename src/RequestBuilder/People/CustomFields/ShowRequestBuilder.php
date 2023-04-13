<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People\CustomFields;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\Validator\CustomFields\ShowValidator;

/**
 * The request builder to create a valid "show" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class ShowRequestBuilder extends AbstractRequestBuilder implements
    IncludesRequestBuilderInterface
{
    use IncludesTrait;

    /**
     * Whether to include the custom fields type or not.
     *
     * @param bool $includeCustomFieldsType TRUE to include custom fields type in the result
     *
     * @return ShowRequestBuilder
     */
    public function setIncludeCustomFieldsType(bool $includeCustomFieldsType): ShowRequestBuilder
    {
        if ($includeCustomFieldsType) {
            $this->addInclude(Constants::CUSTOM_FIELDS_INCLUDE_CUSTOM_FIELDS_TYPE);
        }

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return ShowRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): ShowRequest
    {
        // Validate the input
        ShowValidator::validate($this->data);

        // Assign values to request
        $request = new ShowRequest();

        $this->assignIncludesToRequest($request);

        $this->data = [];

        return $request;
    }
}
