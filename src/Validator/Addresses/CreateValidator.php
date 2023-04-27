<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\Addresses;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

use function in_array;

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
        if (empty($data['address']['street'])) {
            throw new RequestValidatorException(
                'Please provide at least the street name of the address to create'
            );
        }
        if (!isset($data['type'])) {
            return;
        }

        if (in_array($data['type'], Constants::ADDRESS_TYPE, true)) {
            return;
        }

        throw new RequestValidatorException(
            'The provided address type parameter "' . $data['type'] . '" is not allowed'
        );
    }
}
