<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\People;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

/**
 * Class IndexValidator.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class IndexValidator
{
    /**
     * List of allowed "includes" parameters.
     *
     * @var string[]
     */
    private static $allowedIncludes = [
        'positions',
        'companies',
        'tags',
        'avatar',
        'tels',
        'emails',
        'homepages',
        'addrs',
        'custom_fields',
        'connections',
        'all',
    ];

    /**
     * Validate request data before sending it to the web service.
     *
     * @param array<string, mixed> $data
     *
     * @throws RequestValidatorException
     */
    public static function validate(array $data): void
    {
        if (isset($data['includes'])) {
            foreach ($data['includes'] as $include) {
                if (!in_array($include, self::$allowedIncludes, true)) {
                    throw new RequestValidatorException(
                        'The provided include parameter "' . $include . '" is not allowed'
                    );
                }
            }
        }
    }
}
