<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

use Netresearch\Sdk\CentralStation\Api\RequestBuilderInterface;

/**
 * An abstract request builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
abstract class AbstractRequestBuilder implements RequestBuilderInterface
{
    /**
     * The collected data used to build the request.
     *
     * @var array<string, mixed>
     */
    protected $data = [];
}
