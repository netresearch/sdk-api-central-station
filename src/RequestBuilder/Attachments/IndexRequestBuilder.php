<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Attachments;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Attachments\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\Validator\Attachments\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class IndexRequestBuilder extends AbstractRequestBuilder implements IncludesRequestBuilderInterface, PaginationRequestBuilderInterface
{
    use IncludesTrait;
    use PaginationTrait;

    /**
     * Whether to include comments or not.
     *
     * @param bool $includeComments TRUE to include comments in the result
     *
     * @return self
     */
    public function setIncludeComments(bool $includeComments): IndexRequestBuilder
    {
        if ($includeComments) {
            $this->addInclude(Constants::ATTACHMENT_INCLUDE_COMMENTS);
        }

        return $this;
    }

    /**
     * Whether to include the user or not.
     *
     * @param bool $includeUser TRUE to include the user in the result
     *
     * @return self
     */
    public function setIncludeUser(bool $includeUser): IndexRequestBuilder
    {
        if ($includeUser) {
            $this->addInclude(Constants::ATTACHMENT_INCLUDE_USER);
        }

        return $this;
    }

    /**
     * Whether to include the attachment category or not.
     *
     * @param bool $includeCategory TRUE to include the attachment category in the result
     *
     * @return self
     */
    public function setIncludeCategory(bool $includeCategory): IndexRequestBuilder
    {
        if ($includeCategory) {
            $this->addInclude(Constants::ATTACHMENT_INCLUDE_CATEGORY);
        }

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return IndexRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): IndexRequest
    {
        // Validate the input
        IndexValidator::validate($this->data);

        // Assign values to request
        $request = new IndexRequest();

        $this->assignPaginationToRequest($request);
        $this->assignIncludesToRequest($request);

        $this->data = [];

        return $request;
    }
}
