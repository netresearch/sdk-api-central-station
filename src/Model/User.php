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
 * A user.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class User
{
    /**
     * ID of entity.
     *
     * @var int
     */
    public int $id;

    /**
     * The first name.
     *
     * @var string
     */
    public string $first;

    /**
     * The last name.
     *
     * @var string
     */
    public string $name;

    /**
     * The login name.
     *
     * @var string
     */
    public string $login;
}
