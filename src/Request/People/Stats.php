<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Api\ShowRequestInterface;

/**
 * A "stats" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Stats implements ShowRequestInterface
{
    /**
     * @var string[][]
     */
    private $filter;

    /**
     * Sets a list of filters:
     *
     * [
     *     <field1> => [
     *         <comparison-method1> => <value1>
     *     ],
     *     <field2> => [
     *         <comparison-method2> => <value2>
     *     ],
     * ]
     *
     * @param string[][] $filter The list of filters
     *
     * @return Stats
     */
    public function setFilter(array $filter): Stats
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return array<string, array<array<string>>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if (!empty($this->filter)) {
            $data['filter'] = $this->filter;
        }

        return $data;
    }
}
