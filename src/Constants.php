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
 *
 * @api
 */
class Constants
{
    /**
     * Valid gender options.
     *
     * @var string
     */
    final public const GENDER_MALE = 'male_user';

    /**
     * @var string
     */
    final public const GENDER_FEMALE = 'female_user';

    /**
     * @var string
     */
    final public const GENDER_UNKNOWN = 'gender_unknown';

    /**
     * Order by types.
     *
     * @var string
     */
    final public const ORDER_BY_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    final public const ORDER_BY_UPDATED_AT = 'updated_at';

    /**
     * @var string
     */
    final public const ORDER_BY_ACTIVITY = 'activity';

    /**
     * @var string
     */
    final public const ORDER_BY_NAME = 'name';

    /**
     * Order types.
     *
     * @var string
     */
    final public const ORDER_DIRECTION_ASC = 'asc';

    /**
     * @var string
     */
    final public const ORDER_DIRECTION_DESC = 'desc';

    /**
     * Order types.
     *
     * @var string
     */
    final public const SORT_BY_NAME = 'name';

    /**
     * @var string
     */
    final public const SORT_BY_FIRST_NAME = 'first_name';

    /**
     * @var string
     */
    final public const SORT_BY_PHONE = 'phone';

    /**
     * @var string
     */
    final public const SORT_BY_EMAIL = 'email';

    /**
     * List of allowed "search" fields.
     *
     * @var string[]
     */
    final public const SORT_BY = [
        Constants::SORT_BY_NAME,
        Constants::SORT_BY_FIRST_NAME,
        Constants::SORT_BY_PHONE,
        Constants::SORT_BY_EMAIL,
    ];

    /**
     * Filter comparison methods.
     *
     * @var string
     */
    final public const FILTER_LARGER_THAN = 'larger_than';

    /**
     * @var string
     */
    final public const FILTER_SMALLER_THAN = 'smaller_than';

    /**
     * @var string
     */
    final public const FILTER_EQUAL = 'equal';

    /**
     * @var string
     */
    final public const FILTER_IN = 'in';

    /**
     * @var string
     */
    final public const FILTER_BETWEEN = 'between';

    /**
     * @var string
     */
    final public const FILTER_LIKE = 'like';

    /**
     * Include types.
     *
     * @var string
     */
    final public const INCLUDE_POSITIONS = 'positions';

    /**
     * @var string
     */
    final public const INCLUDE_COMPANIES = 'companies';

    /**
     * @var string
     */
    final public const INCLUDE_TAGS = 'tags';

    /**
     * @var string
     */
    final public const INCLUDE_AVATAR = 'avatar';

    /**
     * @var string
     */
    final public const INCLUDE_PHONE_NUMBERS = 'tels';

    /**
     * @var string
     */
    final public const INCLUDE_EMAILS = 'emails';

    /**
     * @var string
     */
    final public const INCLUDE_HOMEPAGES = 'homepages';

    /**
     * @var string
     */
    final public const INCLUDE_ADDRESSES = 'addrs';

    /**
     * @var string
     */
    final public const INCLUDE_CUSTOM_FIELDS = 'custom_fields';

    /**
     * @var string
     */
    final public const INCLUDE_CONNECTIONS = 'connections';

    /**
     * @var string
     */
    final public const INCLUDE_ALL = 'all';

    /**
     * List of include types.
     *
     * @var string[]
     */
    final public const PEOPLE_INCLUDE = [
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
     * Attachable types.
     *
     * @var string
     */
    final public const ATTACHABLE_TYPE_PERSON = 'Person';

    /**
     * @var string
     */
    final public const ATTACHABLE_TYPE_COMPANY = 'Company';

    /**
     * @var string
     */
    final public const ATTACHABLE_TYPE_DEAL = 'Deal';

    /**
     * @var string
     */
    final public const ATTACHABLE_TYPE_PROJECT = 'Project';

    /**
     * List of attachable types.
     *
     * @var string[]
     */
    final public const ATTACHABLE_TYPE = [
        Constants::ATTACHABLE_TYPE_PERSON,
        Constants::ATTACHABLE_TYPE_COMPANY,
        Constants::ATTACHABLE_TYPE_DEAL,
        Constants::ATTACHABLE_TYPE_PROJECT,
    ];

    /**
     * Protocol include types.
     *
     * @var string
     */
    final public const PROTOCOL_INCLUDE_COMMENTS = 'comments';

    /**
     * @var string
     */
    final public const PROTOCOL_INCLUDE_ALL = 'all';

    /**
     * Protocol format types.
     *
     * @var string
     */
    final public const PROTOCOL_FORMAT_PLAINTEXT = 'plaintext';

    /**
     * @var string
     */
    final public const PROTOCOL_FORMAT_MARKDOWN = 'markdown';

    /**
     * @var string
     */
    final public const PROTOCOL_FORMAT_TEXTILE = 'textile';

    /**
     * @var string
     */
    final public const PROTOCOL_FORMAT_HTML = 'html';

    /**
     * List of protocol format types.
     *
     * @var string[]
     */
    final public const PROTOCOL_FORMAT = [
        Constants::PROTOCOL_FORMAT_HTML,
        Constants::PROTOCOL_FORMAT_MARKDOWN,
        Constants::PROTOCOL_FORMAT_PLAINTEXT,
        Constants::PROTOCOL_FORMAT_TEXTILE,
    ];

    /**
     * Protocol badge types.
     *
     * @var string
     */
    final public const PROTOCOL_BADGE_NOTE = 'note';

    /**
     * @var string
     */
    final public const PROTOCOL_BADGE_CALL = 'call';

    /**
     * @var string
     */
    final public const PROTOCOL_BADGE_EMAIL = 'email';

    /**
     * @var string
     */
    final public const PROTOCOL_BADGE_MEETING = 'meeting';

    /**
     * @var string
     */
    final public const PROTOCOL_BADGE_OTHER = 'other';

    /**
     * @var string
     */
    final public const PROTOCOL_BADGE_RESEARCH = 'research'; // Companies only
    /**
     * List of protocol badge types.
     *
     * @var string[]
     */
    final public const PROTOCOL_BADGE = [
        Constants::PROTOCOL_BADGE_CALL,
        Constants::PROTOCOL_BADGE_EMAIL,
        Constants::PROTOCOL_BADGE_MEETING,
        Constants::PROTOCOL_BADGE_NOTE,
        Constants::PROTOCOL_BADGE_OTHER,
        Constants::PROTOCOL_BADGE_RESEARCH,
    ];

    /**
     * Protocol include types.
     *
     * @var string
     */
    final public const ATTACHMENT_INCLUDE_COMMENTS = 'comments';

    /**
     * @var string
     */
    final public const ATTACHMENT_INCLUDE_USER = 'user';

    /**
     * @var string
     */
    final public const ATTACHMENT_INCLUDE_CATEGORY = 'attachment_category';

    /**
     * @var string
     */
    final public const ATTACHMENT_INCLUDE_ALL = 'all';

    /**
     * Address types.
     *
     * @var string
     */
    final public const ADDRESS_TYPE_WORK_HQ = 'work_hq';

    /**
     * @var string
     */
    final public const ADDRESS_TYPE_WORK = 'work';

    /**
     * @var string
     */
    final public const ADDRESS_TYPE_INVOICE = 'invoice';

    /**
     * @var string
     */
    final public const ADDRESS_TYPE_DELIVERY = 'delivery';

    /**
     * @var string
     */
    final public const ADDRESS_TYPE_PRIVATE = 'private';

    /**
     * @var string
     */
    final public const ADDRESS_TYPE_OTHER = 'other';

    /**
     * List of address types.
     *
     * @var string[]
     */
    final public const ADDRESS_TYPE = [
        Constants::ADDRESS_TYPE_WORK_HQ,
        Constants::ADDRESS_TYPE_WORK,
        Constants::ADDRESS_TYPE_DELIVERY,
        Constants::ADDRESS_TYPE_INVOICE,
        Constants::ADDRESS_TYPE_PRIVATE,
        Constants::ADDRESS_TYPE_OTHER,
    ];

    /**
     * Custom field type categories.
     *
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_CATEGORY_PERSON = 'Person';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_CATEGORY_COMPANY = 'Company';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_CATEGORY_DEAL = 'Deal';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_CATEGORY_PROJECT = 'Project';

    /**
     * List of custom field types categories.
     *
     * @var string[]
     */
    final public const CUSTOM_FIELDS_TYPE_CATEGORY = [
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_PERSON,
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_COMPANY,
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_DEAL,
        Constants::CUSTOM_FIELDS_TYPE_CATEGORY_PROJECT,
    ];

    /**
     * Custom field type field types.
     *
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_STRING = 'string';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_SELECT = 'select';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_DECIMAL = 'decimal';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_DATE = 'date';

    /**
     * @var string
     */
    final public const CUSTOM_FIELDS_TYPE_FIELD_TYPE_URL = 'url';

    /**
     * List of field types for custom field types.
     *
     * @var string[]
     */
    final public const CUSTOM_FIELDS_TYPE_FIELD_TYPE = [
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_STRING,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_SELECT,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_DECIMAL,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_DATE,
        Constants::CUSTOM_FIELDS_TYPE_FIELD_TYPE_URL,
    ];

    /**
     * Custom fields include types.
     *
     * @var string
     */
    final public const CUSTOM_FIELDS_INCLUDE_CUSTOM_FIELDS_TYPE = 'custom_fields_type';

    /**
     * Contact types.
     *
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_OFFICE = 'office';

    /**
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_OFFICE_HQ = 'office_hq';

    /**
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_MOBILE = 'mobile';

    /**
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_FAX = 'fax';

    /**
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_PRIVATE = 'private';

    /**
     * @var string
     */
    final public const CONTACT_DETAIL_STYPE_VOIP = 'voip';

    /**
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_SKYPE = 'skype';

    /**
     * @var string
     */
    final public const CONTACT_DETAILS_TYPE_OTHER = 'other';

    /**
     * List of contact detail types.
     *
     * @var string[]
     */
    final public const CONTACT_DETAILS_TYPE = [
        Constants::CONTACT_DETAILS_TYPE_OFFICE,
        Constants::CONTACT_DETAILS_TYPE_OFFICE_HQ,
        Constants::CONTACT_DETAILS_TYPE_MOBILE,
        Constants::CONTACT_DETAILS_TYPE_FAX,
        Constants::CONTACT_DETAILS_TYPE_PRIVATE,
        Constants::CONTACT_DETAIL_STYPE_VOIP,
        Constants::CONTACT_DETAILS_TYPE_SKYPE,
        Constants::CONTACT_DETAILS_TYPE_OTHER,
    ];

    /**
     * Calendar event include types.
     *
     * @var string
     */
    final public const CALENDAR_EVENTS_INCLUDE_ALL = 'all';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_INCLUDE_USER = 'user';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_INCLUDE_USERS = 'users';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_INCLUDE_GROUP_CALENDAR = 'group_calendar';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_INCLUDE_PEOPLE = 'people';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_INCLUDE_ATTENDEES = 'cal_event_attendees';

    /**
     * The list of calendar events include types.
     *
     * @var string[]
     */
    final public const CALENDAR_EVENTS_INCLUDE = [
        Constants::CALENDAR_EVENTS_INCLUDE_ALL,
        Constants::CALENDAR_EVENTS_INCLUDE_USER,
        Constants::CALENDAR_EVENTS_INCLUDE_USERS,
        Constants::CALENDAR_EVENTS_INCLUDE_GROUP_CALENDAR,
        Constants::CALENDAR_EVENTS_INCLUDE_PEOPLE,
        Constants::CALENDAR_EVENTS_INCLUDE_ATTENDEES,
    ];

    /**
     * Calendar event include types.
     *
     * @var string
     */
    final public const CALENDAR_EVENTS_STATUS_NEW = 'new';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_STATUS_CONFIRMED = 'confirmed';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_STATUS_TENTATIVE = 'tentative';

    /**
     * @var string
     */
    final public const CALENDAR_EVENTS_STATUS_CANCELLED = 'cancelled';

    /**
     * List of calendar events status types.
     *
     * @var string[]
     */
    final public const CALENDAR_EVENT_STATUS = [
        Constants::CALENDAR_EVENTS_STATUS_NEW,
        Constants::CALENDAR_EVENTS_STATUS_CONFIRMED,
        Constants::CALENDAR_EVENTS_STATUS_TENTATIVE,
        Constants::CALENDAR_EVENTS_STATUS_CANCELLED,
    ];
}
