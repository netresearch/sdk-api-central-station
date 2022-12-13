<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Protocols;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Protocols\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\SortRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\SortTrait;
use Netresearch\Sdk\CentralStation\Validator\Protocols\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class IndexRequestBuilder extends AbstractRequestBuilder implements
    IncludesRequestBuilderInterface,
    PaginationRequestBuilderInterface,
    SortRequestBuilderInterface
{
    use IncludesTrait;
    use PaginationTrait;
    use SortTrait;

    /**
     * Whether to include comments or not.
     *
     * @param bool $includeComments TRUE to include comments in the result
     *
     * @return IndexRequestBuilder
     */
    public function setIncludeComments(bool $includeComments): IndexRequestBuilder
    {
        if ($includeComments) {
            $this->data['includes'][] = Constants::PROTOCOL_INCLUDE_COMMENTS;
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
        IndexValidator::validate($this->data);

        // Assign values to request
        $request = new IndexRequest();

        $this->assignPaginationToRequest($request);
        $this->assignSortToRequest($request);
        $this->assignIncludesToRequest($request);

        $this->data = [];

        return $request;
    }
}
