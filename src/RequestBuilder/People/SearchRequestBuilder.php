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
use Netresearch\Sdk\CentralStation\Request\People\Search as SearchRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\SearchValidator;

/**
 * The request builder to create a valid "search" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class SearchRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @param string $field
     * @param string $value
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

        if (isset($this->data['search'])) {
            $request->setQuery($this->data['search']);
        }

        $this->data = [];

        return $request;
    }
}
