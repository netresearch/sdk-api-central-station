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
 * @api
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
     * Order by types.
     */
    public const ORDER_BY_CREATED_AT = 'created_at';
    public const ORDER_BY_UPDATED_AT = 'updated_at';
    public const ORDER_BY_ACTIVITY = 'activity';
    public const ORDER_BY_NAME = 'name';

    /**
     * Order types.
     */
    public const ORDER_DIRECTION_ASC = 'asc';
    public const ORDER_DIRECTION_DESC = 'desc';

    /**
     * Order types.
     */
    public const SORT_BY_NAME = 'name';
    public const SORT_BY_FIRST_NAME = 'first_name';
    public const SORT_BY_PHONE = 'phone';
    public const SORT_BY_EMAIL = 'email';

    /**
     * List of allowed "search" fields.
     *
     * @var string[]
     */
    public const SORT_BY = [
        Constants::SORT_BY_NAME,
        Constants::SORT_BY_FIRST_NAME,
        Constants::SORT_BY_PHONE,
        Constants::SORT_BY_EMAIL,
    ];

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
     * List of include types.
     *
     * @var string[]
     */
    public const PEOPLE_INCLUDE = [
        Constants::INCLUDE_POSITIONS,
        Constants::INCLUDE_COMPANIES,
        Constants::INCLUDE_TAGS,
        Constants::INCLUDE_AVATAR,
        Constants::INCLUDE_PHONE_NUMBERS,
        Constants::INCLUDE_EMAILS,
        Constants::INCLUDE_HOMEPAGES,
        Constants::INCLUDE_ADDRESSES,
        Constants::INCLUDE_CUSTOM_FIELDS,
        Constants::INCLUDE_CONNECTIONS,
        Constants::INCLUDE_ALL,
    ];

    /**
     * Tag attachable types.
     */
    public const TAG_TYPE_PERSON = 'Person';
    public const TAG_TYPE_COMPANY = 'Company';
    public const TAG_TYPE_DEAL = 'Deal';
    public const TAG_TYPE_PROJECT = 'Project';

    /**
     * Protocol include types.
     */
    public const PROTOCOL_INCLUDE_COMMENTS = 'comments';
    public const PROTOCOL_INCLUDE_ALL = 'all';

    /**
     * Protocol format types.
     */
    public const PROTOCOL_FORMAT_PLAINTEXT = 'plaintext';
    public const PROTOCOL_FORMAT_MARKDOWN = 'markdown';
    public const PROTOCOL_FORMAT_TEXTILE = 'textile';
    public const PROTOCOL_FORMAT_HTML = 'html';

    /**
     * List of protocol format types.
     *
     * @var string[]
     */
    public const PROTOCOL_FORMAT = [
        Constants::PROTOCOL_FORMAT_HTML,
        Constants::PROTOCOL_FORMAT_MARKDOWN,
        Constants::PROTOCOL_FORMAT_PLAINTEXT,
        Constants::PROTOCOL_FORMAT_TEXTILE,
    ];

    /**
     * Protocol badge types.
     */
    public const PROTOCOL_BADGE_NOTE = 'note';
    public const PROTOCOL_BADGE_CALL = 'call';
    public const PROTOCOL_BADGE_EMAIL = 'email';
    public const PROTOCOL_BADGE_MEETING = 'meeting';
    public const PROTOCOL_BADGE_OTHER = 'other';
    public const PROTOCOL_BADGE_RESEARCH = 'research'; // Companies only

    /**
     * List of protocol badge types.
     *
     * @var string[]
     */
    public const PROTOCOL_BADGE = [
        Constants::PROTOCOL_BADGE_CALL,
        Constants::PROTOCOL_BADGE_EMAIL,
        Constants::PROTOCOL_BADGE_MEETING,
        Constants::PROTOCOL_BADGE_NOTE,
        Constants::PROTOCOL_BADGE_OTHER,
        Constants::PROTOCOL_BADGE_RESEARCH,
    ];

    /**
     * Protocol include types.
     */
    public const ATTACHMENT_INCLUDE_COMMENTS = 'comments';
    public const ATTACHMENT_INCLUDE_USER = 'user';
    public const ATTACHMENT_INCLUDE_CATEGORY = 'attachment_category';
    public const ATTACHMENT_INCLUDE_ALL = 'all';

    /**
     * Address types.
     */
    public const ADDRESS_TYPE_WORK_HQ = 'work_hq';
    public const ADDRESS_TYPE_WORK = 'work';
    public const ADDRESS_TYPE_INVOICE = 'invoice';
    public const ADDRESS_TYPE_DELIVERY = 'delivery';
    public const ADDRESS_TYPE_PRIVATE = 'private';
    public const ADDRESS_TYPE_OTHER = 'other';

    /**
     * List of address types.
     *
     * @var string[]
     */
    public const ADDRESS_TYPE = [
        Constants::ADDRESS_TYPE_WORK_HQ,
        Constants::ADDRESS_TYPE_WORK,
        Constants::ADDRESS_TYPE_DELIVERY,
        Constants::ADDRESS_TYPE_INVOICE,
        Constants::ADDRESS_TYPE_PRIVATE,
        Constants::ADDRESS_TYPE_OTHER,
    ];

    /**
     * Custom field type categories.
     */
    public const CUSTOM_FIELDS_TYPE_CATEGORY_PERSON = 'Person';
    public const CUSTOM_FIELDS_TYPE_CATEGORY_COMPANY = 'Company';
    public const CUSTOM_FIELDS_TYPE_CATEGORY_DEAL = 'Deal';
    public const CUSTOM_FIELDS_TYPE_CATEGORY_PROJECT = 'Project';

    /**
     * List of custom field types categories.
     *
     * @var string[]
     */
    public const CUSTOM_FIELDS_TYPE_CATEGORY = [
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_PERSON,
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_COMPANY,
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_DEAL,
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_PROJECT,
    ];

    /**
     * Custom field type field types.
     */
    public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_STRING = 'string';
    public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_SELECT = 'select';
    public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_DECIMAL = 'decimal';
    public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_DATE = 'date';
    public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_URL = 'url';

    /**
     * List of field types for custom field types.
     *
     * @var string[]
     */
    public const CUSTOM_FIELDS_TYPE_FIELD_TYPE = [
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_STRING,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_SELECT,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_DECIMAL,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_DATE,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_URL,
    ];

    /**
     * Custom fields include types.
     */
    public const CUSTOM_FIELDS_INCLUDE_CUSTOM_FIELDS_TYPE = 'custom_fields_type';

    /**
     * Contact types.
     */
    public const CONTACT_DETAILS_TYPE_OFFICE = 'office';
    public const CONTACT_DETAILS_TYPE_OFFICE_HQ = 'office_hq';
    public const CONTACT_DETAILS_TYPE_MOBILE = 'mobile';
    public const CONTACT_DETAILS_TYPE_FAX = 'fax';
    public const CONTACT_DETAILS_TYPE_PRIVATE = 'private';
    public const CONTACT_DETAIL_STYPE_VOIP = 'voip';
    public const CONTACT_DETAILS_TYPE_SKYPE = 'skype';
    public const CONTACT_DETAILS_TYPE_OTHER = 'other';

    /**
     * List of contact detail types.
     *
     * @var string[]
     */
    public const CONTACT_DETAILS_TYPE = [
        Constants::CONTACT_DETAILS_TYPE_OFFICE,
        Constants::CONTACT_DETAILS_TYPE_OFFICE_HQ,
        Constants::CONTACT_DETAILS_TYPE_MOBILE,
        Constants::CONTACT_DETAILS_TYPE_FAX,
        Constants::CONTACT_DETAILS_TYPE_PRIVATE,
        Constants::CONTACT_DETAIL_STYPE_VOIP,
        Constants::CONTACT_DETAILS_TYPE_SKYPE,
        Constants::CONTACT_DETAILS_TYPE_OTHER,
    ];
}
