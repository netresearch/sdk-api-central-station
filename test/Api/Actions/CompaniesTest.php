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
use Netresearch\Sdk\CentralStation\Model\Container\Collection\CompanyContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\CompanyContainer;
use Netresearch\Sdk\CentralStation\Model\Company;
use Netresearch\Sdk\CentralStation\Model\Tag;
use Netresearch\Sdk\CentralStation\Request\Companies\Create;
use Netresearch\Sdk\CentralStation\Request\Companies\Index;
use Netresearch\Sdk\CentralStation\Request\Companies\Search;
use Netresearch\Sdk\CentralStation\Request\Companies\Show;
use Netresearch\Sdk\CentralStation\Request\Companies\Stats;
use Netresearch\Sdk\CentralStation\Request\Companies\Update;
use Netresearch\Sdk\CentralStation\Test\Provider\CompaniesProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class CompaniesTest
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CompaniesTest extends TestCase
{
    /**
     * Returns an instance of the companies API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $companyId
     *
     * @return \Netresearch\Sdk\CentralStation\Api\Actions\Companies
     * @throws ServiceException
     */
    private function getCompaniesApi(
        string $responseJsonFile = '',
        int $companyId = null
    ): \Netresearch\Sdk\CentralStation\Api\Actions\Companies {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->companies($companyId);
    }

    /**
     * @return string[][]
     */
    public function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                CompaniesProvider::indexResponseSuccess(),
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
        $companiesApi = $this->getCompaniesApi($responseJsonFile);
        $result       = $companiesApi->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/companies', $companiesApi);
        self::assertHttpMethod('GET', $companiesApi);
        self::assertInstanceOf(CompanyContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(CompanyContainer::class, $result);

        foreach ($result as $companies) {
            self::assertInstanceOf(CompanyContainer::class, $companies);
            self::assertInstanceOf(Company::class, $companies->company);
        }

        self::assertFirstCompany($result->offsetGet(0)->company);
        self::assertSecondCompany($result->offsetGet(1)->company);
    }

    /**
     * Asserts that the data of the given company matches the expected values.
     *
     * @param Company $company
     *
     * @return void
     */
    private static function assertFirstCompany(Company $company): void
    {
        self::assertSame(123456789, $company->id);
        self::assertSame(12345, $company->accountId);
        self::assertSame(12346, $company->groupId);
        self::assertSame('ABC company', $company->name);
        self::assertNull($company->background);
        self::assertNull($company->userId);
        self::assertSame('24.01.2022', $company->createdAt->format('d.m.Y'));
        self::assertSame('07.03.2023 14:16:16', $company->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given company matches the expected values.
     *
     * @param Company $company
     *
     * @return void
     */
    private static function assertSecondCompany(Company $company): void
    {
        self::assertSame(123456790, $company->id);
        self::assertSame(12345, $company->accountId);
        self::assertSame(12346, $company->groupId);
        self::assertSame('DEF company', $company->name);
        self::assertNull($company->background);
        self::assertNull($company->userId);
        self::assertSame('24.01.2022', $company->createdAt->format('d.m.Y'));
        self::assertSame('07.03.2023 14:16:16', $company->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                CompaniesProvider::showResponseSuccess(),
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
        $companiesApi = $this->getCompaniesApi($responseJsonFile, 123456);
        $result       = $companiesApi->show(new Show());

        self::assertWebserviceUrl('https://www.example.org/companies/123456', $companiesApi);
        self::assertHttpMethod('GET', $companiesApi);
        self::assertInstanceOf(Company::class, $result);

        self::assertThirdCompany($result);
    }

    /**
     * Asserts that the data of the given company matches the expected values.
     *
     * @param Company $company
     *
     * @return void
     */
    private static function assertThirdCompany(Company $company): void
    {
        self::assertSame(123456789, $company->id);
        self::assertSame(12345, $company->accountId);
        self::assertSame(12346, $company->groupId);
        self::assertSame('ABC company', $company->name);
        self::assertNull($company->background);
        self::assertNull($company->userId);
        self::assertSame('24.01.2022', $company->createdAt->format('d.m.Y'));
        self::assertSame('07.03.2023 14:16:16', $company->updatedAt->format('d.m.Y H:i:s'));
        self::assertInstanceOf(TagCollection::class, $company->tags);
        self::assertContainsOnlyInstancesOf(Tag::class, $company->tags);
        self::assertInstanceOf(AddressCollection::class, $company->addresses);
        self::assertContainsOnlyInstancesOf(Address::class, $company->addresses);
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                CompaniesProvider::createResponseSuccess(),
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
        $companiesApi = $this->getCompaniesApi($responseJsonFile);

        $result = $companiesApi
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Company()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/companies', $companiesApi);
        self::assertHttpMethod('POST', $companiesApi);
        self::assertHttpHeaders($companiesApi);
        self::assertInstanceOf(Company::class, $result);
        self::assertCreatedCompany($result);
    }

    /**
     * Asserts that the data of the given company matches the expected values.
     *
     * @param Company $company
     *
     * @return void
     */
    private static function assertCreatedCompany(Company $company): void
    {
        self::assertSame(123456791, $company->id);
        self::assertSame(12345, $company->accountId);
        self::assertSame(12346, $company->groupId);
        self::assertSame('GHI company', $company->name);
        self::assertNull($company->background);
        self::assertNull($company->userId);
        self::assertSame('24.01.2022', $company->createdAt->format('d.m.Y'));
        self::assertSame('07.03.2023 14:16:16', $company->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $companiesApi = $this->getCompaniesApi('', 123456);
        $result       = $companiesApi->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/companies/123456', $companiesApi);
        self::assertHttpHeaders($companiesApi);
        self::assertHttpMethod('PUT', $companiesApi);
        self::assertTrue($result);
    }

    /**
     * @return string[][]
     */
    public function statsResponseDataProvider(): array
    {
        return [
            'Response' => [
                CompaniesProvider::statsResponseSuccess(),
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
        $companiesApi = $this->getCompaniesApi($responseJsonFile);
        $result       = $companiesApi->stats(new Stats());

        self::assertWebserviceUrl('https://www.example.org/companies/stats', $companiesApi);
        self::assertHttpHeaders($companiesApi);
        self::assertHttpMethod('GET', $companiesApi);
        self::assertSame(25, $result);
    }

    /**
     * @return string[][]
     */
    public function searchResponseDataProvider(): array
    {
        return [
            'Response' => [
                CompaniesProvider::searchResponseSuccess(),
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
        $companiesApi = $this->getCompaniesApi($responseJsonFile);
        $result       = $companiesApi->search(new Search());

        self::assertWebserviceUrl('https://www.example.org/companies/search', $companiesApi);
        self::assertHttpMethod('GET', $companiesApi);
        self::assertHttpHeaders($companiesApi);
        self::assertInstanceOf(CompanyContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(CompanyContainer::class, $result);

        foreach ($result as $companies) {
            self::assertInstanceOf(CompanyContainer::class, $companies);
            self::assertInstanceOf(Company::class, $companies->company);
        }

        self::assertSearchedCompany($result->offsetGet(0)->company);
    }

    /**
     * Asserts that the data of the given company matches the expected values.
     *
     * @param Company $company
     *
     * @return void
     */
    private static function assertSearchedCompany(Company $company): void
    {
        self::assertSame(123456789, $company->id);
        self::assertSame(12345, $company->accountId);
        self::assertSame(12346, $company->groupId);
        self::assertSame('ABC company', $company->name);
        self::assertNull($company->background);
        self::assertNull($company->userId);
        self::assertSame('24.01.2022', $company->createdAt->format('d.m.Y'));
        self::assertSame('07.03.2023 14:16:16', $company->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "delete" method.
     *
     * @test
     */
    public function delete(): void
    {
        $companiesApi = $this->getCompaniesApi('', 123456);
        $result       = $companiesApi->delete();

        self::assertWebserviceUrl('https://www.example.org/companies/123456', $companiesApi);
        self::assertHttpHeaders($companiesApi);
        self::assertHttpMethod('DELETE', $companiesApi);
        self::assertTrue($result);
    }
}
