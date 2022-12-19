<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Traits;

use Netresearch\Sdk\CentralStation\Request\FilterRequestInterface;

/**
 * The filter trait.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait FilterTrait
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
     * @return self
     */
    public function setFilter(array $filter): FilterRequestInterface
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * Adds the defined data to the data to be serialized and returns the updated structure.
     *
     * @param mixed[] $data The data to serialize
     *
     * @return mixed[]
     */
    private function addFilterToSerializedData(array $data): array
    {
        if (!empty($this->filter)) {
            $data['filter'] = $this->filter;
        }

        return $data;
    }
}
