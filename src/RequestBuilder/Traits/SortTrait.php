<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Traits;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\SortRequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\SortRequestBuilderInterface;

/**
 * Trait providing methods to add sort options to request builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait SortTrait
{
    /**
     * Sets the sort order of the response.
     *
     * @param null|string $orderBy        The order type (use one of Constants::ORDER_BY_*)
     * @param null|string $orderDirection The order direction (use one of Constants::ORDER_DIRECTION_*)
     *
     * @return self
     */
    public function setOrder(
        ?string $orderBy = Constants::ORDER_BY_NAME,
        ?string $orderDirection = Constants::ORDER_DIRECTION_ASC
    ): SortRequestBuilderInterface {
        $this->data['order'] = [
            'orderBy'   => $orderBy,
            'direction' => $orderDirection,
        ];

        return $this;
    }

    /**
     * Assigns the defined data to the request.
     *
     * @param SortRequestInterface $request The request instance
     *
     * @return void
     */
    private function assignSortToRequest(SortRequestInterface $request): void
    {
        if (isset($this->data['order'])) {
            if ($this->data['order']['orderBy'] !== null) {
                $request->setOrderBy($this->data['order']['orderBy']);
            }

            if ($this->data['order']['direction'] !== null) {
                $request->setOrderDirection($this->data['order']['direction']);
            }
        }
    }
}
