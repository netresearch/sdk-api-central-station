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
 * A position record.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Position extends AbstractEntity
{
    /**
     * ID of an account.
     *
     * @var int
     */
    public int $accountId;

    /**
     * ID of the linked person.
     *
     * @var int
     */
    public int $personId;

    /**
     * ID of the linked company.
     *
     * @var int
     */
    public int $companyId;

    /**
     * Title of the item, e.g., Managing director, HR manager, etc.
     *
     * @var null|string
     */
    public ?string $name = null;

    /**
     * Department in which the person works.
     *
     * @var null|string
     */
    public ?string $department = null;

    /**
     * Only one position may be set to primary. This will mark the primary position the person holds.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $primaryFunction = false;

    /**
     * Positions that are no longer active may be marked as former.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $former = false;

    /**
     * States whether the tag has been added via the API or some sort of integration.
     *
     * @var bool
     *
     * @ReplaceNullWithDefaultValue
     */
    public bool $apiInput = false;
}
