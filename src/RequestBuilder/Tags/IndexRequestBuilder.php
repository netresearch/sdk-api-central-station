<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Tags;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Tags\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\FilterRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\SortRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\FilterTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\SortTrait;
use Netresearch\Sdk\CentralStation\Validator\Tags\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class IndexRequestBuilder extends AbstractRequestBuilder implements FilterRequestBuilderInterface, PaginationRequestBuilderInterface, SortRequestBuilderInterface
{
    use FilterTrait;
    use PaginationTrait;
    use SortTrait;

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
        $this->assignSortToRequest($request);
        $this->assignFilterToRequest($request);

        $this->data = [];

        return $request;
    }
}
