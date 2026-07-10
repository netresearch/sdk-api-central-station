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
 * An abstract request builder for "create" requests, providing the contact
 * detail methods shared by the entity-specific create builders.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
abstract class AbstractCreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Adds an email address attribute.
     *
     * @param string $type         The type of the email address (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param string $emailAddress The email address
     */
    public function addEmailAddress(string $type, string $emailAddress): static
    {
        $this->addEmailAddressEntry(null, $type, $emailAddress);

        return $this;
    }
}
