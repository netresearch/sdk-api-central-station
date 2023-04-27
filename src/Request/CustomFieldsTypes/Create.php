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
 * A "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Create implements RequestInterface
{
    /**
     * @var CustomFieldsType
     */
    private readonly CustomFieldsType $customFieldsType;

    /**
     * Constructor.
     *
     * @param CustomFieldsType $customFieldsType
     */
    public function __construct(CustomFieldsType $customFieldsType)
    {
        $this->customFieldsType = $customFieldsType;
    }

    /**
     * @return array<string, array<string, null|int|string|string[]>>
     */
    public function jsonSerialize(): array
    {
        return ['custom_fields_type' => $this->customFieldsType->jsonSerialize()];
    }
}
