<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\CalendarEvents;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\CalendarEvents\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\FilterRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\SortRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\FilterTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\SortTrait;
use Netresearch\Sdk\CentralStation\Validator\CalendarEvents\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class IndexRequestBuilder extends AbstractRequestBuilder implements
    FilterRequestBuilderInterface,
    IncludesRequestBuilderInterface,
    PaginationRequestBuilderInterface,
    SortRequestBuilderInterface
{
    use FilterTrait;
    use IncludesTrait;
    use PaginationTrait;
    use SortTrait;

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
        $this->assignFilterToRequest($request);
        $this->assignIncludesToRequest($request);

        $this->data = [];

        return $request;
    }
}
