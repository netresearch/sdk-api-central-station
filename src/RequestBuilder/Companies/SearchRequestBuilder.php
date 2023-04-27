<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Companies;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Companies\Search as SearchRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\Validator\Companies\SearchValidator;

/**
 * The request builder to create a valid "search" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class SearchRequestBuilder extends AbstractRequestBuilder implements
    IncludesRequestBuilderInterface,
    PaginationRequestBuilderInterface
{
    use PaginationTrait;
    use IncludesTrait;

    /**
     * Adds a search query.
     *
     * @param string $field The field to search for (use one of Constants::SORT_BY_*)
     * @param string $value The value of the field to search for
     *
     * @return SearchRequestBuilder
     */
    public function addQuery(
        string $field,
        string $value
    ): SearchRequestBuilder {
        $this->data['search'][$field] = $value;

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return SearchRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        SearchValidator::validate($this->data);

        // Assign values to request
        $request = new SearchRequest();

        $this->assignPaginationToRequest($request);
        $this->assignIncludesToRequest($request);

        if (isset($this->data['search'])) {
            $request->setQuery($this->data['search']);
        }

        $this->data = [];

        return $request;
    }
}
