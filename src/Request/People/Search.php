<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Api\IndexRequestInterface;

/**
 * A "search" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Search implements IndexRequestInterface
{
    /**
     * @var string[]
     */
    private $query;

    /**
     * @param string[] $query
     *
     * @return Search
     */
    public function setQuery(array $query): Search
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return array<string, int|string>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (!empty($this->query)) {
            foreach ($this->query as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
