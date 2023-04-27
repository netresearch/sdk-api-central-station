<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Request\Person;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * A "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Create implements RequestInterface
{
    /**
     * @var Person
     */
    private readonly Person $person;

    /**
     * Constructor.
     *
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * @return array<string, array<string, null|string|array<int, array<string, null|bool|int|string>>>>
     */
    public function jsonSerialize(): array
    {
        return ['person' => $this->person->jsonSerialize()];
    }
}
