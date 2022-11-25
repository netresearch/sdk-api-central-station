<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions;

use Netresearch\Sdk\CentralStation\Collection\PeopleCollection;
use Netresearch\Sdk\CentralStation\Model\People;
use Netresearch\Sdk\CentralStation\Model\People\Person;
use Netresearch\Sdk\CentralStation\Request\People\Index;
use Netresearch\Sdk\CentralStation\Test\Provider\People\IndexProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class PeopleTest
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class PeopleTest extends TestCase
{
    /**
     * @return string[][]
     */
    public function indexResponseDataProvider(): array
    {
        return [
            'index' => [
                IndexProvider::indexResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "index" method.
     *
     * @dataProvider indexResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function index(string $responseJsonFile): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->index(new Index());

        self::assertInstanceOf(PeopleCollection::class, $result);
        self::assertContainsOnlyInstancesOf(People::class, $result);

        foreach ($result as $people) {
            self::assertInstanceOf(People::class, $people);
            self::assertInstanceOf(People\Person::class, $people->person);
        }

        $this->assertFirstPerson($result[0]->person);
        $this->assertSecondPerson($result[1]->person);
    }

    private function assertFirstPerson(Person $person)
    {
        self::assertSame(455637, $person->id);
        self::assertSame(21, $person->accountId);
        self::assertNull($person->salutation);
        self::assertSame('', $person->title);
        self::assertSame('female_user', $person->gender);
        self::assertNull($person->countryCode);
        self::assertSame('Marion', $person->firstName);
        self::assertSame('Beber', $person->name);
        self::assertSame('', $person->background);
        self::assertSame(64, $person->userId);
        self::assertSame('27.06.2013', $person->createdAt->format('d.m.Y'));
        self::assertSame('21.05.2015 14:06:00', $person->updatedAt->format('d.m.Y H:i:s'));
    }

    private function assertSecondPerson(Person $person)
    {
        self::assertSame(455636, $person->id);
        self::assertSame(21, $person->accountId);
        self::assertNull($person->salutation);
        self::assertSame('', $person->title);
        self::assertSame('male_user', $person->gender);
        self::assertNull($person->countryCode);
        self::assertSame('Karl-Heinz', $person->firstName);
        self::assertSame('Becker', $person->name);
        self::assertSame('', $person->background);
        self::assertSame(64, $person->userId);
        self::assertSame('27.06.2013', $person->createdAt->format('d.m.Y'));
        self::assertSame('27.04.2015 09:17:00', $person->updatedAt->format('d.m.Y H:i:s'));
    }
}
