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
use Netresearch\Sdk\CentralStation\Request\People\Update;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $person = new Person();
        $person->setFirstName('Maxi')
            ->setLastName('Musterfrau')
            ->setGender(Constants::GENDER_FEMALE)
            ->setTitle('Prof. Dr.')
            ->setSalutation('Frau')
            ->setCountryCode('de')
            ->setBackground('background');

        $request = new Update();
        $request->setPerson($person);

        self::assertSame(
            [
                'person' => [
                    'name'         => 'Musterfrau',
                    'first_name'   => 'Maxi',
                    'gender'       => Constants::GENDER_FEMALE,
                    'title'        => 'Prof. Dr.',
                    'salutation'   => 'Frau',
                    'country_code' => 'de',
                    'background'   => 'background',

                ],
            ],
            $request->jsonSerialize()
        );
    }
}
