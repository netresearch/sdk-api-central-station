<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder;

use function trim;

/**
 * An abstract request builder providing common methods for all request builders.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
abstract class AbstractRequestBuilder implements RequestBuilderInterface
{
    /**
     * The collected data used to build the request.
     *
     * @var array<string, mixed>
     */
    protected array $data = [];

    /**
     * Appends an e-mail address entry to the collected data. The address is
     * trimmed so the stored value matches the (also trimmed) lookup key and a
     * whitespace e-mail never creates a duplicate contact.
     *
     * @param int|null    $id           The ID of the record to update, or null when creating
     * @param string|null $type         The type of the e-mail address (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param string|null $emailAddress The e-mail address
     */
    protected function addEmailAddressEntry(?int $id, ?string $type, ?string $emailAddress): void
    {
        if (!isset($this->data['emailAddresses'])) {
            $this->data['emailAddresses'] = [];
        }

        $this->data['emailAddresses'][] = [
            'id'           => $id,
            'type'         => $type,
            'emailAddress' => $emailAddress === null ? null : trim($emailAddress),
        ];
    }
}
