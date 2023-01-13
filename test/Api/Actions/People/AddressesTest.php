<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions\People;

use Netresearch\Sdk\CentralStation\Api\Actions\People;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Address;
use Netresearch\Sdk\CentralStation\Model\Container\AddressContainer;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\AddressContainerCollection;
use Netresearch\Sdk\CentralStation\Request\People\Addresses\Create;
use Netresearch\Sdk\CentralStation\Request\People\Addresses\Update;
use Netresearch\Sdk\CentralStation\Test\Provider\People\AddressesProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class AddressesTest
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class AddressesTest extends TestCase
{
    /**
     * Returns an instance of the people API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $personId
     *
     * @return People
     * @throws ServiceException
     */
    private function getPeopleApi(
        string $responseJsonFile = '',
        int $personId = null
    ): People {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->people($personId);
    }

    /**
     * @return string[][]
     */
    public function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                AddressesProvider::indexResponseSuccess(),
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
        $peopleApi = $this->getPeopleApi($responseJsonFile, 30016185);
        $result    = $peopleApi->addresses()->index();

        self::assertWebserviceUrl('https://www.example.org/people/30016185/addrs', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(AddressContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(AddressContainer::class, $result);

        foreach ($result as $addresses) {
            self::assertInstanceOf(Address::class, $addresses->addr);
        }
        $this->assertFirstAddress($result->offsetGet(0)->addr);
        $this->assertSecondAddress($result->offsetGet(1)->addr);
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param Address $address
     *
     * @return void
     */
    private function assertFirstAddress(Address $address): void
    {
        self::assertSame(28752100, $address->id);
        self::assertSame(30016185, $address->attachableId);
        self::assertSame('Person', $address->attachableType);
        self::assertSame('work_hq', $address->type);
        self::assertSame('', $address->street);
        self::assertSame('', $address->zip);
        self::assertSame('Leipzig', $address->city);
        self::assertSame('DE', $address->countryCode);
        self::assertSame('Deutschland', $address->countryName);
        self::assertSame('SN', $address->stateCode);
        self::assertFalse($address->primary);
        self::assertFalse($address->apiInput);
        self::assertSame('14.12.2022', $address->createdAt->format('d.m.Y'));
        self::assertSame('14.12.2022 15:49:49', $address->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param Address $address
     *
     * @return void
     */
    private function assertSecondAddress(Address $address): void
    {
        self::assertSame(28762507, $address->id);
        self::assertSame(30016185, $address->attachableId);
        self::assertSame('Person', $address->attachableType);
        self::assertSame('other', $address->type);
        self::assertSame('Mustergasse 1', $address->street);
        self::assertSame('98765', $address->zip);
        self::assertSame('Musterstadt', $address->city);
        self::assertSame('DE', $address->countryCode);
        self::assertSame('Deutschland', $address->countryName);
        self::assertNull($address->stateCode);
        self::assertFalse($address->primary);
        self::assertTrue($address->apiInput);
        self::assertSame('16.12.2022', $address->createdAt->format('d.m.Y'));
        self::assertSame('16.12.2022 09:52:17', $address->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                AddressesProvider::showResponseSuccess(),
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
        $peopleApi = $this->getPeopleApi($responseJsonFile, 26146820);
        $address   = $peopleApi->addresses()->show();

        self::assertWebserviceUrl('https://www.example.org/people/26146820/addrs', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Address::class, $address);

        $this->assertThirdAddress($address);
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param Address $address
     *
     * @return void
     */
    private function assertThirdAddress(Address $address): void
    {
        self::assertSame(25045244, $address->id);
        self::assertSame(26146820, $address->attachableId);
        self::assertSame('Person', $address->attachableType);
        self::assertSame('work', $address->type);
        self::assertSame('', $address->street);
        self::assertSame('01187', $address->zip);
        self::assertSame('Dresden', $address->city);
        self::assertSame('DE', $address->countryCode);
        self::assertSame('Deutschland', $address->countryName);
        self::assertSame('SN', $address->stateCode);
        self::assertFalse($address->primary);
        self::assertFalse($address->apiInput);
        self::assertSame('24.01.2022', $address->createdAt->format('d.m.Y'));
        self::assertSame('24.01.2022 11:09:17', $address->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                AddressesProvider::createResponseSuccess(),
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
        $peopleApi = $this->getPeopleApi($responseJsonFile, 30016185);

        $address = $peopleApi
            ->addresses()
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Address()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/people/30016185/addrs', $peopleApi);
        self::assertHttpMethod('POST', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(Address::class, $address);

        $this->assertCreatedAddress($address);
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param Address $address
     *
     * @return void
     */
    private function assertCreatedAddress(Address $address): void
    {
        self::assertSame(28763152, $address->id);
        self::assertSame(30016185, $address->attachableId);
        self::assertSame('Person', $address->attachableType);
        self::assertSame('private', $address->type);
        self::assertSame('Mustergasse 1', $address->street);
        self::assertSame('12345', $address->zip);
        self::assertSame('Musterhausen', $address->city);
        self::assertSame('DE', $address->countryCode);
        self::assertSame('Deutschland', $address->countryName);
        self::assertNull($address->stateCode);
        self::assertTrue($address->primary);
        self::assertTrue($address->apiInput);
        self::assertSame('16.12.2022', $address->createdAt->format('d.m.Y'));
        self::assertSame('16.12.2022 10:53:03', $address->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $peopleApi = $this->getPeopleApi('', 30016185);
        $result    = $peopleApi->addresses(25045244)->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/people/30016185/addrs/25045244', $peopleApi);
        self::assertHttpMethod('PUT', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }

    /**
     * Tests "delete" method.
     *
     * @test
     */
    public function delete(): void
    {
        $peopleApi = $this->getPeopleApi('', 30016185);
        $result    = $peopleApi->addresses(25045244)->delete();

        self::assertWebserviceUrl('https://www.example.org/people/30016185/addrs/25045244', $peopleApi);
        self::assertHttpMethod('DELETE', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }
}
