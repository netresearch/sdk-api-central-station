<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\Validator\People\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class IndexRequestBuilder extends AbstractRequestBuilder
{
    use IncludesTrait;

    /**
     * Sets the limitations of the response.
     *
     * @param null|int $perPage The number of elements to return (default: 25)
     * @param null|int $page    The page number for which to return the results
     *
     * @return IndexRequestBuilder
     */
    public function setLimit(
        int $perPage = null,
        int $page = null
    ): IndexRequestBuilder {
        $this->data['limit'] = [
            'perPage' => $perPage,
            'page'    => $page,
        ];

        return $this;
    }

    /**
     * Sets the sort order of the response.
     *
     * @param null|string $orderBy        The order type (either "created_at", "updated_at", "activity" or "name" (default))
     * @param null|string $orderDirection The order direction (either "asc" (Default) or "desc")
     *
     * @return IndexRequestBuilder
     */
    public function setOrder(
        string $orderBy = null,
        string $orderDirection = null
    ): IndexRequestBuilder {
        $this->data['order'] = [
            'orderBy'   => $orderBy,
            'direction' => $orderDirection,
        ];

        return $this;
    }

    /**
     * Adds a filter.
     *
     * @param string $filter A filter to apply to the result
     *
     * @return IndexRequestBuilder
     */
    public function addFilter(string $filter): IndexRequestBuilder
    {
        // TODO

//        if (!isset($this->data['filter'])) {
//            $this->data['filter'] = [];
//        }
//
//        if (!in_array($filter, $this->data['filter'], true)) {
//            $this->data['filter'][] = $filter;
//        }

        return $this;
    }

    /**
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

        if (isset($this->data['limit'])) {
            if (($this->data['limit']['perPage'] !== null) && ($this->data['limit']['perPage'] > 0)) {
                $request->setPerPage($this->data['limit']['perPage']);
            }

            if (($this->data['limit']['page'] !== null) && ($this->data['limit']['page'] > 0)) {
                $request->setPage($this->data['limit']['page']);
            }
        }

        if (isset($this->data['order'])) {
            if (($this->data['order']['orderBy'] !== null) && ($this->data['order']['orderBy'] > 0)) {
                $request->setOrderBy($this->data['order']['orderBy']);
            }

            if (($this->data['order']['direction'] !== null) && ($this->data['order']['direction'] > 0)) {
                $request->setOrderDirection($this->data['order']['direction']);
            }
        }

        if (isset($this->data['filter'])) {
            $request->setFilter($this->data['filter']);
        }

        if (isset($this->data['includes'])) {
            $request->setIncludes(...$this->data['includes']);
        }

        $this->data = [];

        return $request;
    }
}
