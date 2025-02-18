<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\GroupCalendars;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\GroupCalendars\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class IndexRequestBuilder extends AbstractRequestBuilder implements IncludesRequestBuilderInterface
{
    use IncludesTrait;

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
        //        IndexValidator::validate($this->data);

        // Assign values to request
        $request = new IndexRequest();

        $this->assignIncludesToRequest($request);

        $this->data = [];

        return $request;
    }
}
