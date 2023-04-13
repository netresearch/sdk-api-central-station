<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Validator\Traits;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;

/**
 * Validator to validate the "filter" parameter.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait FilterTrait
{
    /**
     * List of allowed "filter" parameters. The list of people can be narrowed down by
     * any of the person fields.
     *
     * @var string[]
     */
    private static $allowedFilters = [
        'id',
        'account_id',
        'salutation',
        'title',
        'gender',
        'country_code',
        'first_name',
        'name',
        'background',
        'user_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Validate request data before sending it to the web service.
     *
     * @param string[] $filters The "filter" data collected by the request builder
     *
     * @throws RequestValidatorException
     */
    public static function validateFilters(array $filters): void
    {
        foreach ($filters as $filter => $values) {
            if (!\in_array($filter, self::$allowedFilters, true)) {
                throw new RequestValidatorException(
                    'The provided filter parameter "' . $filter . '" is not allowed'
                );
            }
        }
    }
}
