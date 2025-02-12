<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Collection;

use Netresearch\Sdk\CentralStation\Model\Address;

/**
 * An address collection.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractCollection<int, Address>
 */
class AddressCollection extends AbstractCollection
{
    /**
     * Returns the first address item matching the given address type.
     *
     * @param string $type
     *
     * @return Address|null
     */
    public function getByType(string $type): ?Address
    {
        /** @var Address $address */
        foreach ($this as $address) {
            if ($address->type === $type) {
                return $address;
            }
        }

        return null;
    }
}
