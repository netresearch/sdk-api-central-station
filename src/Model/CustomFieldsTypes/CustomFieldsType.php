<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\CustomFieldsTypes;

use MagicSunday\JsonMapper\Annotation\ReplaceNullWithDefaultValue;
use MagicSunday\JsonMapper\Annotation\ReplaceProperty;
use Netresearch\Sdk\CentralStation\Model\AbstractEntity;

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
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * Arrangement of the individual field type in the display.
     *
     * @var int
     */
    public $position;

    /**
     * @var bool
     */
    public $visibleForAllGroups;

    /**
     * Range of the individual field type (e.g. Person, Company, Deal or Project).
     *
     * @var string
     */
    public $category;

    /**
     * Type of custom field (e.g. string, date, select, decimal or url).
     *
     * @var string
     */
    public $type;

    /**
     * The name of the custom field type.
     *
     * @var string
     */
    public $name;

    /**
     * The options if type is "select".
     *
     * @var string[]
     *
     * @ReplaceNullWithDefaultValue
     */
    public $options = [];

    /**
     * API only created or used field?
     *
     * @var bool
     */
    public $apiOnly;
}
