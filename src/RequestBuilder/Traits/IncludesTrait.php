<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Traits;

/**
 * Trait providing method to add includes to request builder.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
trait IncludesTrait
{
    /**
     * Adds an include.
     *
     * @param string $include The name of an additional data to include in the
     *                        response (use one of Constants::INCLUDE_*). Use Constants::INCLUDE_ALL to return
     *                        all at once.
     *
     * @return self
     */
    public function addInclude(string $include): self
    {
        if (!isset($this->data['includes'])) {
            $this->data['includes'] = [];
        }

        if (!in_array($include, $this->data['includes'], true)) {
            $this->data['includes'][] = $include;
        }

        return $this;
    }
}
