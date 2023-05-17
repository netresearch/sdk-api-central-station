<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

use DateTime;

/**
 * The filter request builder interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
interface FilterRequestBuilderInterface extends RequestBuilderInterface
{
    /**
     * Adds a filter.
     *
     * @param string              $field      The name of the field to filter
     * @param string              $comparison The comparison type (use one of Constants::FILTER_*)
     * @param int|string|DateTime $value      The value used to filter the field by
     *
     * @return static
     */
    public function addFilter(
        string $field,
        string $comparison,
        int|string|DateTime $value
    ): FilterRequestBuilderInterface;
}
