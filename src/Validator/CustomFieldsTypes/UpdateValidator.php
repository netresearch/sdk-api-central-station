<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\CustomFieldsTypes;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

use function in_array;

/**
 * Class UpdateValidator.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateValidator
{
    /**
     * Validate request data before sending it to the web service.
     *
     * @param array<string, mixed> $data The data collected by the request builder
     *
     * @throws RequestValidatorException
     */
    public static function validate(array $data): void
    {
        if (
            !isset($data['name'])
            && !isset($data['category'])
            && !isset($data['type'])
            && !isset($data['position'])
            && !isset($data['options'])
        ) {
            throw new RequestValidatorException(
                'Please provide at least one value to update'
            );
        }

        if (
            isset($data['category'])
            && !in_array($data['category'], Constants::CUSTOM_FIELDS_TYPE_CATEGORY, true)
        ) {
            throw new RequestValidatorException(
                'The provided category parameter "' . $data['category'] . '" is not allowed'
            );
        }

        if (!isset($data['type'])) {
            return;
        }

        if (in_array($data['type'], Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE, true)) {
            return;
        }

        throw new RequestValidatorException(
            'The provided field type parameter "' . $data['type'] . '" is not allowed'
        );
    }
}
