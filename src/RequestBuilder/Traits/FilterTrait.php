<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Traits;

use DateTime;
use Netresearch\Sdk\CentralStation\Request\FilterRequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\FilterRequestBuilderInterface;

/**
 * Trait providing methods to add filters to request builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait FilterTrait
{
    /**
     * Adds a filter.
     *
     * @param string              $field      The name of the field to filter
     * @param string              $comparison The comparison type (use one of Constants::FILTER_*)
     * @param int|string|DateTime $value      The value used to filter the field by, add "%" around value to
     *                                        the LIKE filter to filter for partial value
     *
     * @return self
     */
    public function addFilter(string $field, string $comparison, $value): FilterRequestBuilderInterface
    {
        if (!isset($this->data['filter'])) {
            $this->data['filter'] = [];
        }

        if ($value instanceof DateTime) {
            $value = $value->format('Y-m-d');
        }

        $this->data['filter'][$field][$comparison] = $value;

        return $this;
    }

    /**
     * Assigns the defined data to the request.
     *
     * @param FilterRequestInterface $request The request instance
     *
     * @return void
     */
    private function assignFilterToRequest(FilterRequestInterface $request): void
    {
        if (isset($this->data['filter'])) {
            $request->setFilter($this->data['filter']);
        }
    }
}
