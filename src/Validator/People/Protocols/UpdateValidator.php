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
     * List of allowed values.
     *
     * @var string[]
     */
    private static $allowedFormats = [
        Constants::PROTOCOL_FORMAT_HTML,
        Constants::PROTOCOL_FORMAT_MARKDOWN,
        Constants::PROTOCOL_FORMAT_PLAINTEXT,
        Constants::PROTOCOL_FORMAT_TEXTILE,
    ];

    /**
     * List of allowed values.
     *
     * @var string[]
     */
    private static $allowedBadges = [
        Constants::PROTOCOL_BADGE_CALL,
        Constants::PROTOCOL_BADGE_EMAIL,
        Constants::PROTOCOL_BADGE_MEETING,
        Constants::PROTOCOL_BADGE_NOTE,
        Constants::PROTOCOL_BADGE_OTHER,
        Constants::PROTOCOL_BADGE_RESEARCH,
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
        if (!in_array($data['protocol']['format'], self::$allowedFormats, true)) {
            throw new RequestValidatorException(
                'The provided format parameter "' . $data['protocol']['format'] . '" is not allowed'
            );
        }

        if (!in_array($data['protocol']['badge'], self::$allowedBadges, true)) {
            throw new RequestValidatorException(
                'The provided badge parameter "' . $data['protocol']['badge'] . '" is not allowed'
            );
        }
    }
}
