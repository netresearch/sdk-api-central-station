<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\Traits;

use Netresearch\Sdk\CentralStation\Request\CustomFieldRequestInterface;

/**
 * The custom field filter trait.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait CustomFieldTrait
{
    /**
     * @var array<array<string>|int|string>
     */
    private $customFieldFilter;

    /**
     * Sets a custom field filter.
     *
     * @param string     $name  The name of the custom field used to filter
     * @param int|string $value The value used to filter the field by
     *
     * @return self
     */
    public function setCustomFieldFilter(string $name, $value): CustomFieldRequestInterface
    {
        $this->customFieldFilter[$name] = $value;
        return $this;
    }

    /**
     * Adds the defined data to the data to be serialized and returns the updated structure.
     *
     * @param mixed[] $data The data to serialize
     *
     * @return mixed[]
     */
    private function addCustomFieldToSerializedData(array $data): array
    {
        if (!empty($this->customFieldFilter)) {
            $data['custom_fields']['custom_field_type_name'] = key($this->customFieldFilter);
            $data['custom_fields']['value']                  = current($this->customFieldFilter);
        }

        return $data;
    }
}
