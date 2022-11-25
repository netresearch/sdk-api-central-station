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
    /**
     * Adds a filter.
     *
     * @param string $field      The name of the field to filter
     * @param string $comparison The comparison type (use one of Constants::FILTER_*)
     * @param string $value      The value used to filter the field by
     *
     * @return StatsRequestBuilder
     */
    public function addFilter(
        string $field,
        string $comparison,
        string $value
    ): StatsRequestBuilder {
        if (!isset($this->data['filter'])) {
            $this->data['filter'] = [];
        }

        $this->data['filter'][$field][$comparison] = $value;

        return $this;
    }

    /**
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
