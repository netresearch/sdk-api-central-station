<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

/**
 * An abstract request builder for "update" requests, providing the contact
 * detail methods shared by the entity-specific update builders.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
abstract class AbstractUpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Adds an email address attribute.
     *
     * @param int|null    $id           The ID of the record to update
     * @param string|null $type         The type of the email address (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param string|null $emailAddress The email address
     */
    public function addEmailAddress(
        ?int $id = null,
        ?string $type = null,
        ?string $emailAddress = null,
    ): static {
        $this->addEmailAddressEntry($id, $type, $emailAddress);

        return $this;
    }
}
