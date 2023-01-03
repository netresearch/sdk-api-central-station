<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\CustomFieldsType;

use MagicSunday\JsonMapper\Annotation\ReplaceNullWithDefaultValue;
use Netresearch\Sdk\CentralStation\Model\AbstractEntity;

/**
 * A custom field type record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CustomFieldType extends AbstractEntity
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
    public $ftype;

    /**
     * The name of the custom field type.
     *
     * @var
     */
    public $name;

    /**
     * @var array
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
