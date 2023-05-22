<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use MagicSunday\JsonMapper\Annotation\ReplaceNullWithDefaultValue;

/**
 * A custom field record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CustomField extends AbstractEntity
{
    /**
     * ID of an account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * The ID of the record the custom field belongs to, e.g. person, company, offer or project.
     *
     * @var int
     */
    public int $attachableId;

    /**
     * The record type the custom field belongs to. Must be either "Person", "Company", "Deal" or "Project".
     *
     * @var string
     */
    public string $attachableType;

    /**
     * States whether the tag has been added via the API or some sort of integration.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $apiInput = false;

    /**
     * The value of the custom field (decimal and date types may store their values separately).
     *
     * @var string
     */
    public string $name;

    /**
     * The value in decimal representation, if the type of the custom field is "decimal".
     *
     * @var null|string
     */
    public ?string $nameDecimal = null;

    /**
     * The value in ISO-8601 date representation, if the type of the custom field is "date".
     *
     * @var null|string
     */
    public ?string $nameDate = null;

    /**
     * The ID of the underlying custom fields type.
     *
     * @var int
     */
    public int $customFieldsTypeId;

    /**
     * The name of the underlying custom fields type.
     *
     * @var null|string
     */
    public ?string $customFieldsTypeName = null;

    /**
     * A custom fields type.
     *
     * @var null|CustomFieldsType
     */
    public ?CustomFieldsType $customFieldsType = null;
}
