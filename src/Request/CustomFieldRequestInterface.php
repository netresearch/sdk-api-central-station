<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request;

/**
 * The custom field filter request interface.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
interface CustomFieldRequestInterface extends RequestInterface
{
    /**
     * Sets a custom field filter.
     *
     * @param string     $name  The name of the custom field used to filter
     * @param int|string $value The value used to filter the field by
     *
     * @return self
     */
    public function setCustomFieldFilter(string $name, int|string $value): CustomFieldRequestInterface;
}
