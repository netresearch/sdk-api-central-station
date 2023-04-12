<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions;

use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Address;
use Netresearch\Sdk\CentralStation\Model\Collection\AddressCollection;
use Netresearch\Sdk\CentralStation\Model\Collection\TagCollection;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\PersonContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\PersonContainer;
use Netresearch\Sdk\CentralStation\Model\Person;
use Netresearch\Sdk\CentralStation\Model\Tag;
use Netresearch\Sdk\CentralStation\Request\People\Create;
use Netresearch\Sdk\CentralStation\Request\People\Index;
use Netresearch\Sdk\CentralStation\Request\People\Merge;
use Netresearch\Sdk\CentralStation\Request\People\Search;
use Netresearch\Sdk\CentralStation\Request\People\Show;
use Netresearch\Sdk\CentralStation\Request\People\Stats;
use Netresearch\Sdk\CentralStation\Request\People\Update;
use Netresearch\Sdk\CentralStation\Test\Provider\PeopleProvider;
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
     * Returns an instance of the people API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $personId
     *
     * @return \Netresearch\Sdk\CentralStation\Api\Actions\People
     * @throws ServiceException
     */
    private function getPeopleApi(
        string $responseJsonFile = '',
        int $personId = null
    ): \Netresearch\Sdk\CentralStation\Api\Actions\People {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->people($personId);
    }

    /**
     * @return string[][]
     */
    public static function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                PeopleProvider::indexResponseSuccess(),
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
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile);
        $result    = $peopleApi->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/people', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertInstanceOf(PersonContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(PersonContainer::class, $result);

        foreach ($result as $people) {
            self::assertInstanceOf(PersonContainer::class, $people);
            self::assertInstanceOf(Person::class, $people->person);
        }

        self::assertFirstPerson($result->offsetGet(0)->person);
        self::assertSecondPerson($result->offsetGet(1)->person);
    }

    /**
     * Asserts that the data of the given person matches the expected values.
     *
     * @param Person $person
     *
     * @return void
     */
    private static function assertFirstPerson(Person $person): void
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

    /**
     * Asserts that the data of the given person matches the expected values.
     *
     * @param Person $person
     *
     * @return void
     */
    private static function assertSecondPerson(Person $person): void
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
    public static function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                PeopleProvider::showResponseSuccess(),
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
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile, 123456);
        $result    = $peopleApi->show(new Show());

        self::assertWebserviceUrl('https://www.example.org/people/123456', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertInstanceOf(Person::class, $result);

        self::assertThirdPerson($result);
    }

    /**
     * Asserts that the data of the given person matches the expected values.
     *
     * @param Person $person
     *
     * @return void
     */
    private static function assertThirdPerson(Person $person): void
    {
        self::assertSame(30016185, $person->id);
        self::assertSame(87444, $person->accountId);
        self::assertSame('Frau', $person->salutation);
        self::assertSame('Dr. Dr.', $person->title);
        self::assertSame('female_user', $person->gender);
        self::assertSame('de', $person->countryCode);
        self::assertSame('Maxi', $person->firstName);
        self::assertSame('Mustermann', $person->name);
        self::assertSame('Ich bin Maxi Mustermann.', $person->background);
        self::assertNull($person->userId);
        self::assertSame('29.11.2022', $person->createdAt->format('d.m.Y'));
        self::assertSame('14.12.2022 15:53:43', $person->updatedAt->format('d.m.Y H:i:s'));
        self::assertInstanceOf(TagCollection::class, $person->tags);
        self::assertContainsOnlyInstancesOf(Tag::class, $person->tags);
        self::assertInstanceOf(AddressCollection::class, $person->addresses);
        self::assertContainsOnlyInstancesOf(Address::class, $person->addresses);
    }

    /**
     * @return string[][]
     */
    public static function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                PeopleProvider::createResponseSuccess(),
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
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile);

        $result = $peopleApi
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Person()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/people', $peopleApi);
        self::assertHttpMethod('POST', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Person::class, $result);
        self::assertCreatedPerson($result);
    }

    /**
     * Asserts that the data of the given person matches the expected values.
     *
     * @param Person $person
     *
     * @return void
     */
    private static function assertCreatedPerson(Person $person): void
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
        $peopleApi = $this->getPeopleApi('', 123456);
        $result    = $peopleApi->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/people/123456', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertHttpMethod('PUT', $peopleApi);
        self::assertTrue($result);
    }

    /**
     * @return string[][]
     */
    public static function statsResponseDataProvider(): array
    {
        return [
            'Response' => [
                PeopleProvider::statsResponseSuccess(),
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
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function stats(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile);
        $result    = $peopleApi->stats(new Stats());

        self::assertWebserviceUrl('https://www.example.org/people/stats', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertSame(40, $result);
    }

    /**
     * Tests "merge" method.
     *
     * @test
     */
    public function merge(): void
    {
        $peopleApi = $this->getPeopleApi('', 1);

        $result = $peopleApi
            ->merge(
                (new Merge(1))
                    ->setMergeIds(5, 10, 100)
            );

        self::assertWebserviceUrl('https://www.example.org/people/1/merge', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertHttpMethod('POST', $peopleApi);
        self::assertTrue($result);
    }

    /**
     * @return string[][]
     */
    public static function searchResponseDataProvider(): array
    {
        return [
            'Response' => [
                PeopleProvider::searchResponseSuccess(),
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
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function search(string $responseJsonFile): void
    {
        $peopleApi = $this->getPeopleApi($responseJsonFile);
        $result    = $peopleApi->search(new Search());

        self::assertWebserviceUrl('https://www.example.org/people/search', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(PersonContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(PersonContainer::class, $result);

        foreach ($result as $people) {
            self::assertInstanceOf(PersonContainer::class, $people);
            self::assertInstanceOf(Person::class, $people->person);
        }

        self::assertSearchedPerson($result->offsetGet(0)->person);
    }

    /**
     * Asserts that the data of the given person matches the expected values.
     *
     * @param Person $person
     *
     * @return void
     */
    private static function assertSearchedPerson(Person $person): void
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

    /**
     * Tests "delete" method.
     *
     * @test
     */
    public function delete(): void
    {
        $peopleApi = $this->getPeopleApi('', 123456);
        $result    = $peopleApi->delete();

        self::assertWebserviceUrl('https://www.example.org/people/123456', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertHttpMethod('DELETE', $peopleApi);
        self::assertTrue($result);
    }
}
