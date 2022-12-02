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
    public const GENDER_MALE = 'male_user';
    public const GENDER_FEMALE = 'female_user';
    public const GENDER_UNKNOWN = 'gender_unknown';

    /**
     * Order types.
     */
    public const ORDER_DIRECTION_ASC = 'asc';
    public const ORDER_DIRECTION_DESC = 'desc';

    /**
     * Filter comparison methods.
     */
    public const FILTER_LARGER_THAN = 'larger_than';
    public const FILTER_SMALLER_THAN = 'smaller_than';
    public const FILTER_EQUAL = 'equal';
    public const FILTER_IN = 'in';
    public const FILTER_BETWEEN = 'between';
    public const FILTER_LIKE = 'like';

    /**
     * Include types.
     */
    public const INCLUDE_POSITIONS = 'positions';
    public const INCLUDE_COMPANIES = 'companies';
    public const INCLUDE_TAGS = 'tags';
    public const INCLUDE_AVATAR = 'avatar';
    public const INCLUDE_PHONE_NUMBERS = 'tels';
    public const INCLUDE_EMAILS = 'emails';
    public const INCLUDE_HOMEPAGES = 'homepages';
    public const INCLUDE_ADDRESSES = 'addrs';
    public const INCLUDE_CUSTOM_FIELDS = 'custom_fields';
    public const INCLUDE_CONNECTIONS = 'connections';
    public const INCLUDE_ALL = 'all';

    /**
     * Tag attachable types.
     */
    public const TAG_TYPE_PERSON = 'Person';
    public const TAG_TYPE_COMPANY = 'Company';
    public const TAG_TYPE_DEAL = 'Deal';
    public const TAG_TYPE_PROJECT = 'Project';
}
