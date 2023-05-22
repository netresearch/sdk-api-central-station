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
use MagicSunday\JsonMapper\Annotation\ReplaceProperty;

/**
 * A custom fields type record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @ReplaceProperty("type", replaces="ftype")
 */
class CustomFieldsType extends AbstractEntity
{
    /**
     * ID of an account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * Arrangement of the individual field type in the display.
     *
     * @var int
     */
    public int $position;

    /**
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $visibleForAllGroups = false;

    /**
     * Range of the individual field type (e.g. Person, Company, Deal or Project).
     *
     * @var string
     */
    public string $category;

    /**
     * Type of custom field (e.g. string, date, select, decimal or url).
     *
     * @var string
     */
    public string $type;

    /**
     * The name of the custom field type.
     *
     * @var string
     */
    public string $name;

    /**
     * The options if a type is "select".
     *
     * @var string[]
     *
     * @ReplaceNullWithDefaultValue
     */
    public array $options = [];

    /**
     * API only created or used field?
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $apiOnly = false;
}
