<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\CustomFields;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

/**
 * Class CreateValidator.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateValidator
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
        if (!isset($data['content'])) {
            throw new RequestValidatorException(
                'Please provide the content of the custom field'
            );
        }

        if (!isset($data['customFieldsTypeId'])) {
            throw new RequestValidatorException(
                'Please provide the ID of the underlying custom fields type'
            );
        }
    }
}
