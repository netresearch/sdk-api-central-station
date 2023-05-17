<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Traits;

use Netresearch\Sdk\CentralStation\Request\PaginationRequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;

/**
 * Trait providing methods to add pagination options to request builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait PaginationTrait
{
    /**
     * Sets the limitations of the response.
     *
     * @param int $perPage The number of elements to return (default: 25)
     * @param int $page    The page number for which to return the results
     *
     * @return static
     */
    public function setLimit(int $perPage = 25, int $page = 1): PaginationRequestBuilderInterface
    {
        $this->data['limit'] = [
            'perPage' => $perPage,
            'page'    => $page,
        ];

        return $this;
    }

    /**
     * Assigns the defined data to the request.
     *
     * @param PaginationRequestInterface $request The request instance
     *
     * @return void
     */
    private function assignPaginationToRequest(PaginationRequestInterface $request): void
    {
        if (isset($this->data['limit'])) {
            if ($this->data['limit']['perPage'] > 0) {
                $request->setPerPage($this->data['limit']['perPage']);
            }

            if ($this->data['limit']['page'] > 0) {
                $request->setPage($this->data['limit']['page']);
            }
        }
    }
}
