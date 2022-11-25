<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

/**
 * The request builder interface specifies methods for creating the different
 * parts of the request builder objects.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
interface RequestBuilderInterface
{
    /**
     * Create the request object.
     *
     * @return RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface;
}
