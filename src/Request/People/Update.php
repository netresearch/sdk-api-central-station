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
class Update implements RequestInterface
{
    /**
     * @var int
     */
    private $personId;

    /**
     * @var null|Person
     */
    private $person;

    /**
     * Constructor.
     *
     * @param int $personId
     */
    public function __construct(int $personId)
    {
        $this->personId = $personId;
    }

    /**
     * @return int
     */
    public function getPersonId(): int
    {
        return $this->personId;
    }

    /**
     * @param Person $person
     *
     * @return Update
     */
    public function setPerson(Person $person): Update
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function jsonSerialize(): array
    {
        $data = [];

        if ($this->person) {
            $data['person'] = $this->person->jsonSerialize();
        }

        return $data;
    }
}
