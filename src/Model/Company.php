<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

/**
 * A company record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Company extends AbstractEntity
{
    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of group.
     *
     * @var int
     */
    public $groupId;

    /**
     * ID of the user which created the entry.
     *
     * @var null|int
     */
    public $userId;

    /**
     * The name of the company.
     *
     * @var string
     */
    public $name;

    /**
     * Details about the company e.g. history.
     *
     * @var null|string
     */
    public $background;
}
