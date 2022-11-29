<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\People;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\People\Common\Person;
use Netresearch\Sdk\CentralStation\Request\People\Create;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $person = new Person();
        $person
            ->setFirstName('Max')
            ->setLastName('Mustermann')
            ->setGender(Constants::GENDER_MALE)
            ->setTitle('Dr. Dr.');

        $request = new Create($person);

        self::assertSame(
            [
                'person' => [
                    'name'       => 'Mustermann',
                    'first_name' => 'Max',
                    'gender'     => Constants::GENDER_MALE,
                    'title'      => 'Dr. Dr.',
                    'salutation' => null,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
