<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\CustomFields;

use Netresearch\Sdk\CentralStation\Model\AbstractEntity;

/**
 * A custom fields type record attached to a custom field.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CustomFieldsType extends AbstractEntity
{
    /**
     * Arrangement of the individual field type in the display.
     *
     * @var int
     */
    public $position;

    /**
     * Range of the individual field type (e.g. Person, Company, Deal or Project).
     *
     * @var string
     */
    public $category;

    /**
     * The name of the custom field type.
     *
     * @var string
     */
    public $name;
}
