<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation;

/**
 * Constants.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Constants
{
    /**
     * Valid gender options.
     */
    public const GENDER_MALE    = 'male_user';
    public const GENDER_FEMALE  = 'female_user';
    public const GENDER_UNKNOWN = 'gender_unknown';

    /**
     * Filter comparison methods.
     */
    public const FILTER_LARGER_THAN = 'larger_than';
    public const FILTER_SMALLER_THAN = 'smaller_than';
    public const FILTER_EQUAL = 'equal';
    public const FILTER_IN = 'in';
    public const FILTER_BETWEEN = 'between';
    public const FILTER_LIKE = 'like';
}
