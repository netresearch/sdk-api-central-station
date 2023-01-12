<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model;

use Netresearch\Sdk\CentralStation\Model\AbstractEntity;

/**
 * A position record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Position extends AbstractEntity
{
    /**
     * ID of account.
     *
     * @var int
     */
    public $accountId;

    /**
     * ID of the linked person.
     *
     * @var int
     */
    public $personId;

    /**
     * ID of the linked company.
     *
     * @var int
     */
    public $companyId;

    /**
     * Title of the item, e.g. Managing director, HR manager, etc.
     *
     * @var string
     */
    public $name;

    /**
     * Department in which the person works.
     *
     * @var string
     */
    public $department;

    /**
     * Only one position may be set to primary. This will mark the primary position the person holds.
     *
     * @var bool
     */
    public $primaryFunction;

    /**
     * Positions that are no longer active may be marked as former.
     *
     * @var bool
     */
    public $former;

    /**
     * States whether the tag has been added via the API or some sort of integration.
     *
     * @var bool
     */
    public $apiInput;
}
