<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Model\Collection;

use Netresearch\Sdk\CentralStation\Model\ContactDetail;

/**
 * A contact detail collection.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractCollection<int, ContactDetail>
 */
class ContactDetailCollection extends AbstractCollection
{
    /**
     * Returns the first contact detail item matching the given contact type.
     *
     * @param string $contactType
     *
     * @return null|ContactDetail
     */
    public function getByContactType(string $contactType): ?ContactDetail
    {
        /** @var ContactDetail $contactDetail */
        foreach ($this as $contactDetail) {
            if ($contactDetail->contactType === $contactType) {
                return $contactDetail;
            }
        }

        return null;
    }
}
