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
use Netresearch\Sdk\CentralStation\Request\People\Create;
use Netresearch\Sdk\CentralStation\Request\People\Index;
use Netresearch\Sdk\CentralStation\Request\People\Merge;
use Netresearch\Sdk\CentralStation\Request\People\Search;
use Netresearch\Sdk\CentralStation\Request\People\Show;
use Netresearch\Sdk\CentralStation\Request\People\Stats;
use Netresearch\Sdk\CentralStation\Request\People\Update;
use Netresearch\Sdk\CentralStation\Test\Provider\People\CreateProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\People\IndexProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\People\SearchProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\People\ShowProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\People\StatsProvider;
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
            'Response' => [
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

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                ShowProvider::showResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "show" method.
     *
     * @dataProvider showResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function show(string $responseJsonFile): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->show(new Show(123456));

        self::assertInstanceOf(People\Person::class, $result);

        $this->assertFirstPerson($result);
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                CreateProvider::createResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "create" method.
     *
     * @dataProvider createResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function create(string $responseJsonFile): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\People\Common\Person('')
                )
            );

        self::assertInstanceOf(People\Person::class, $result);

        $this->assertCreatedPerson($result);
    }

    private function assertCreatedPerson(Person $person)
    {
        self::assertSame(1545412, $person->id);
        self::assertSame(21, $person->accountId);
        self::assertNull($person->salutation);
        self::assertNull($person->title);
        self::assertSame('male_user', $person->gender);
        self::assertNull($person->countryCode);
        self::assertSame('Marian', $person->firstName);
        self::assertSame('Miller', $person->name);
        self::assertNull($person->background);
        self::assertNull($person->userId);
        self::assertSame('20.07.2015', $person->createdAt->format('d.m.Y'));
        self::assertSame('20.07.2015 13:26:42', $person->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock();

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->update(
                new Update(123456)
            );

        self::assertTrue($result);
    }

    /**
     * @return string[][]
     */
    public function statsResponseDataProvider(): array
    {
        return [
            'Response' => [
                StatsProvider::statsResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "stats" method.
     *
     * @dataProvider statsResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function stats(string $responseJsonFile): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->stats(new Stats());

        self::assertSame(40, $result);
    }

    /**
     * Tests "merge" method.
     *
     * @test
     */
    public function merge(): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock();

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->merge(
                (new Merge(1))
                    ->setMergeIds(5, 10, 100)
            );

        self::assertTrue($result);
    }

    /**
     * @return string[][]
     */
    public function searchResponseDataProvider(): array
    {
        return [
            'Response' => [
                SearchProvider::searchResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "search" method.
     *
     * @dataProvider searchResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function search(string $responseJsonFile): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->people()
            ->search(new Search());

        self::assertInstanceOf(PeopleCollection::class, $result);
        self::assertContainsOnlyInstancesOf(People::class, $result);

        foreach ($result as $people) {
            self::assertInstanceOf(People::class, $people);
            self::assertInstanceOf(People\Person::class, $people->person);
        }

        $this->assertSearchedPerson($result[0]->person);
    }

    private function assertSearchedPerson(Person $person)
    {
        self::assertSame(235321, $person->id);
        self::assertSame(21, $person->accountId);
        self::assertNull($person->salutation);
        self::assertSame('', $person->title);
        self::assertNull($person->gender);
        self::assertNull($person->countryCode);
        self::assertSame('Jolly', $person->firstName);
        self::assertSame('Mäh', $person->name);
        self::assertSame('', $person->background);
        self::assertSame(1781, $person->userId);
        self::assertSame('12.07.2012', $person->createdAt->format('d.m.Y'));
        self::assertSame('13.01.2015 11:08:08', $person->updatedAt->format('d.m.Y H:i:s'));
    }
}
