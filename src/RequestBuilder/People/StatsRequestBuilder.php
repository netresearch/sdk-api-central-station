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
use Netresearch\Sdk\CentralStation\Request\People\Stats as StatsRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\FilterTrait;
use Netresearch\Sdk\CentralStation\Validator\People\StatsValidator;

/**
 * The request builder to create a valid "stats" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class StatsRequestBuilder extends AbstractRequestBuilder
{
    use FilterTrait;

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return StatsRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        StatsValidator::validate($this->data);

        // Assign values to request
        $request = new StatsRequest();

        if (isset($this->data['filter'])) {
            $request->setFilter($this->data['filter']);
        }

        $this->data = [];

        return $request;
    }
}
