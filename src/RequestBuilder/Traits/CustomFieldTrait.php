<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Traits;

use Netresearch\Sdk\CentralStation\Request\CustomFieldRequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\CustomFieldRequestBuilderInterface;

/**
 * Trait providing methods to add custom field filter to request builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait CustomFieldTrait
{
    /**
     * Sets a custom field filter.
     *
     * @param string     $name  The name of the custom field used to filter
     * @param int|string $value The value used to filter the field by
     *
     * @return CustomFieldRequestBuilderInterface
     */
    public function setCustomFieldFilter(string $name, int|string $value): CustomFieldRequestBuilderInterface
    {
        $this->data['customField'] = [
            'name'  => $name,
            'value' => $value,
        ];

        return $this;
    }

    /**
     * Assigns the defined data to the request.
     *
     * @param CustomFieldRequestInterface $request The request instance
     *
     * @return void
     */
    private function assignCustomFieldToRequest(CustomFieldRequestInterface $request): void
    {
        if (isset($this->data['customField'])) {
            $request->setCustomFieldFilter(
                $this->data['customField']['name'],
                $this->data['customField']['value']
            );
        }
    }
}
