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
     * Validate request data before sending it to the web service.
     *
     * @param array<string, mixed> $data
     *
     * @throws RequestValidatorException
     */
    public static function validate(array $data): void
    {
        // TODO Validate search format


//        name, first_name, phone oder email
    }
}
