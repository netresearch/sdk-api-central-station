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
     * Normalizes an e-mail address by trimming surrounding whitespace, so the
     * stored value matches the (also trimmed) lookup key and a whitespace
     * e-mail never creates a duplicate contact.
     *
     * @param string|null $emailAddress
     */
    protected function normalizeEmailAddress(?string $emailAddress): ?string
    {
        return $emailAddress === null ? null : trim($emailAddress);
    }
}
