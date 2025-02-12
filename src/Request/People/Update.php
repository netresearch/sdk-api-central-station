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
 * A "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de/
 */
class Update implements RequestInterface
{
    /**
     * @var Person|null
     */
    private ?Person $person = null;

    /**
     * @param Person|null $person
     *
     * @return Update
     */
    public function setPerson(?Person $person): Update
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return array<string, array<string, string|array<int, array<string, bool|int|string|null>>|null>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->person instanceof Person) {
            $data['person'] = $this->person->jsonSerialize();
        }

        return $data;
    }
}
