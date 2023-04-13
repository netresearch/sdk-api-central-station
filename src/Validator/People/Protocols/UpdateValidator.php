<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\People\Protocols;

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
        if (!in_array($data['protocol']['format'], Constants::PROTOCOL_FORMAT, true)) {
            throw new RequestValidatorException(
                'The provided format parameter "' . $data['protocol']['format'] . '" is not allowed'
            );
        }

        if (!in_array($data['protocol']['badge'], Constants::PROTOCOL_BADGE, true)) {
            throw new RequestValidatorException(
                'The provided badge parameter "' . $data['protocol']['badge'] . '" is not allowed'
            );
        }
    }
}
