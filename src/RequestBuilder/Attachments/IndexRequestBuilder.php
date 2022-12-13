<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Attachments;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Attachments\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Attachments\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class IndexRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the limitations of the response.
     *
     * @param null|int $perPage The number of elements to return (default: 25)
     * @param null|int $page    The page number for which to return the results
     *
     * @return IndexRequestBuilder
     */
    public function setLimit(
        ?int $perPage = 25,
        ?int $page = 1
    ): IndexRequestBuilder {
        $this->data['limit'] = [
            'perPage' => $perPage,
            'page'    => $page,
        ];

        return $this;
    }

    /**
     * Whether to include comments or not.
     *
     * @param bool $includeComments TRUE to include comments in the result
     *
     * @return self
     */
    public function setIncludeComments(bool $includeComments): self
    {
        if ($includeComments) {
            $this->data['includes'][] = Constants::ATTACHMENT_INCLUDE_COMMENTS;
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
    public function setIncludeUser(bool $includeUser): self
    {
        if ($includeUser) {
            $this->data['includes'][] = Constants::ATTACHMENT_INCLUDE_USER;
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
    public function setIncludeCategory(bool $includeCategory): self
    {
        if ($includeCategory) {
            $this->data['includes'][] = Constants::ATTACHMENT_INCLUDE_CATEGORY;
        }

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return IndexRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
//        IndexValidator::validate($this->data);

        // Assign values to request
        $request = new IndexRequest();

        if (isset($this->data['limit'])) {
            if (($this->data['limit']['perPage'] !== null) && ($this->data['limit']['perPage'] > 0)) {
                $request->setPerPage($this->data['limit']['perPage']);
            }

            if (($this->data['limit']['page'] !== null) && ($this->data['limit']['page'] > 0)) {
                $request->setPage($this->data['limit']['page']);
            }
        }

        if (isset($this->data['includes'])) {
            $request->setIncludes(...$this->data['includes']);
        }

        $this->data = [];

        return $request;
    }
}
