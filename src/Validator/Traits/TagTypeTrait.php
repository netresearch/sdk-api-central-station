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
 * Validator to validate the attachable type parameter of a tag.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait TagTypeTrait
{
    /**
     * List of allowed values.
     *
     * @var string[]
     */
    private static $allowedAttachableTypes = [
        Constants::TAG_TYPE_PERSON,
        CONSTANTS::TAG_TYPE_COMPANY,
        CONSTANTS::TAG_TYPE_DEAL,
        CONSTANTS::TAG_TYPE_PROJECT,
    ];

    /**
     * Validate request data before sending it to the web service.
     *
     * @param string $attachableType The "attachableType" data collected by the request builder
     *
     * @throws RequestValidatorException
     */
    public static function validateAttachableType(string $attachableType): void
    {
        if (!in_array($attachableType, self::$allowedAttachableTypes, true)) {
            throw new RequestValidatorException(
                'The provided attachable type "' . $attachableType . '" is not allowed'
            );
        }
    }
}
