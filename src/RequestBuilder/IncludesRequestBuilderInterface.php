<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

/**
 * The includes request builder interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
interface IncludesRequestBuilderInterface extends RequestBuilderInterface
{
    /**
     * Adds an include.
     *
     * @param string $include The name of an additional data to include in the
     *                        response (use one of Constants::INCLUDE_*). Use Constants::INCLUDE_ALL to return
     *                        all at once.
     *
     * @return static
     */
    public function addInclude(string $include): IncludesRequestBuilderInterface;
}
