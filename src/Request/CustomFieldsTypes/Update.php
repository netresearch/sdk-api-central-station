<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\CustomFieldsTypes;

use Netresearch\Sdk\CentralStation\Request\CustomFieldsType;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Update implements RequestInterface
{
    /**
     * @var CustomFieldsType|null
     */
    private ?CustomFieldsType $customFieldsType = null;

    /**
     * @param CustomFieldsType|null $customFieldsType
     *
     * @return Update
     */
    public function setCustomFieldsType(?CustomFieldsType $customFieldsType): Update
    {
        $this->customFieldsType = $customFieldsType;

        return $this;
    }

    /**
     * @return array<string, array<string, int|string|string[]|null>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->customFieldsType instanceof CustomFieldsType) {
            $data['custom_fields_type'] = $this->customFieldsType->jsonSerialize();
        }

        return $data;
    }
}
