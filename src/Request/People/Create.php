<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Request\People;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Request\People\Common\Person;

/**
 * A batch request used to send multiple hits in a single request.
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
    private $person;

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
     * @return array<string, array<string, string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        $data['person'] = $this->person->jsonSerialize();

        return $data;
    }
}
