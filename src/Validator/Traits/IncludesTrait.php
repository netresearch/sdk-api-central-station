<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\Traits;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

/**
 * Validator to validate the "includes" parameter.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait IncludesTrait
{
    /**
     * List of allowed "includes" parameters.
     *
     * @var string[]
     */
    private static $allowedIncludes = [
        Constants::INCLUDE_POSITIONS,
        CONSTANTS::INCLUDE_COMPANIES,
        CONSTANTS::INCLUDE_TAGS,
        CONSTANTS::INCLUDE_AVATAR,
        CONSTANTS::INCLUDE_PHONE_NUMBERS,
        CONSTANTS::INCLUDE_EMAILS,
        CONSTANTS::INCLUDE_HOMEPAGES,
        CONSTANTS::INCLUDE_ADDRESSES,
        CONSTANTS::INCLUDE_CUSTOM_FIELDS,
        CONSTANTS::INCLUDE_CONNECTIONS,
        CONSTANTS::INCLUDE_ALL,
    ];

    /**
     * Validate request data before sending it to the web service.
     *
     * @param string[] $includes The "includes" data collected by the request builder
     *
     * @throws RequestValidatorException
     */
    public static function validateIncludes(array $includes): void
    {
        foreach ($includes as $include) {
            if (!in_array($include, self::$allowedIncludes, true)) {
                throw new RequestValidatorException(
                    'The provided include parameter "' . $include . '" is not allowed'
                );
            }
        }
    }
}
