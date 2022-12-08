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
 * Class SearchValidator.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class SearchValidator
{
    /**
     * List of allowed "search" fields.
     *
     * @var string[]
     */
    private static $allowedSearchFields = [
        'name',
        'first_name',
        'phone',
        'email',
    ];

    /**
     * Validate request data before sending it to the web service.
     *
     * @param array<string, mixed> $data The data collected by the request builder
     *
     * @throws RequestValidatorException
     */
    public static function validate(array $data): void
    {
        foreach ($data['search'] as $search => $value) {
            if (!in_array($search, self::$allowedSearchFields, true)) {
                throw new RequestValidatorException(
                    'The provided search parameter "' . $search . '" is not allowed'
                );
            }
        }
    }
}
