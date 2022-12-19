<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\Validator\People\ShowValidator;

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
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return ShowRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
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
