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
use Netresearch\Sdk\CentralStation\Model\Container\CustomFieldContainer;
use Netresearch\Sdk\CentralStation\Model\CustomField;
use Netresearch\Sdk\CentralStation\Model\CustomFieldsType;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Create;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Index;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Show;
use Netresearch\Sdk\CentralStation\Request\People\CustomFields\Update;
use Netresearch\Sdk\CentralStation\Test\Provider\People\CustomFieldsProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class CustomFieldsTest
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CustomFieldsTest extends TestCase
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
                CustomFieldsProvider::indexResponseSuccess(),
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
        $peopleApi = $this->getPeopleApi($responseJsonFile,
            12345678);
        $result    = $peopleApi->customFields()->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/people/12345678/custom_fields', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertContainsOnlyInstancesOf(CustomFieldContainer::class, $result);

        foreach ($result as $customFields) {
            self::assertInstanceOf(CustomField::class, $customFields->customField);
        }

        self::assertFirstCustomField($result->offsetGet(0)->customField);
        self::assertSecondCustomField($result->offsetGet(1)->customField);
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param CustomField $customField
     *
     * @return void
     */
    private static function assertFirstCustomField(CustomField $customField): void
    {
        self::assertSame(2000, $customField->id);
        self::assertSame(12345678, $customField->attachableId);
        self::assertSame('Person', $customField->attachableType);
        self::assertSame(10000, $customField->accountId);
        self::assertFalse($customField->apiInput);
        self::assertSame('https://www.example.org', $customField->name);
        self::assertNull($customField->nameDate);
        self::assertNull($customField->nameDecimal);
        self::assertSame(1000, $customField->customFieldsTypeId);
        self::assertSame('CUSTOM-FIELD-TYPE-STRING', $customField->customFieldsTypeName);
        self::assertInstanceOf(CustomFieldsType::class, $customField->customFieldsType);
        self::assertSame('02.01.2023', $customField->createdAt->format('d.m.Y'));
        self::assertSame('02.01.2023 02:02:02', $customField->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param CustomField $customField
     *
     * @return void
     */
    private static function assertSecondCustomField(CustomField $customField): void
    {
        self::assertSame(2001, $customField->id);
        self::assertSame(12345678, $customField->attachableId);
        self::assertSame('Person', $customField->attachableType);
        self::assertSame(10000, $customField->accountId);
        self::assertTrue($customField->apiInput);
        self::assertSame('Option-2', $customField->name);
        self::assertNull($customField->nameDate);
        self::assertNull($customField->nameDecimal);
        self::assertSame(1001, $customField->customFieldsTypeId);
        self::assertSame('CUSTOM-FIELD-TYPE-SELECT', $customField->customFieldsTypeName);
        self::assertInstanceOf(CustomFieldsType::class, $customField->customFieldsType);
        self::assertSame('02.01.2023', $customField->createdAt->format('d.m.Y'));
        self::assertSame('02.01.2023 02:02:02', $customField->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                CustomFieldsProvider::showResponseSuccess(),
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
        $peopleApi   = $this->getPeopleApi($responseJsonFile,
            12345678);
        $customField = $peopleApi->customFields(2000)->show(new Show());

        self::assertWebserviceUrl('https://www.example.org/people/12345678/custom_fields/2000', $peopleApi);
        self::assertHttpMethod('GET', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(CustomField::class, $customField);

        self::assertFirstCustomField($customField);
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                CustomFieldsProvider::createResponseSuccess(),
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
        $peopleApi = $this->getPeopleApi($responseJsonFile,
            12345678);

        $customField = $peopleApi
            ->customFields()
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\CustomField()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/people/12345678/custom_fields', $peopleApi);
        self::assertHttpMethod('POST', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertInstanceOf(CustomField::class, $customField);

        self::assertCreatedCustomField($customField);
    }

    /**
     * Asserts that the data of the given address matches the expected values.
     *
     * @param CustomField $customField
     *
     * @return void
     */
    private static function assertCreatedCustomField(CustomField $customField): void
    {
        self::assertSame(2002, $customField->id);
        self::assertSame(12345678, $customField->attachableId);
        self::assertSame('Person', $customField->attachableType);
        self::assertSame(10000, $customField->accountId);
        self::assertTrue($customField->apiInput);
        self::assertSame('MY-CUSTOM-FIELD-VALUE', $customField->name);
        self::assertNull($customField->nameDate);
        self::assertNull($customField->nameDecimal);
        self::assertSame(1000, $customField->customFieldsTypeId);
        self::assertNull($customField->customFieldsTypeName);
        self::assertNull($customField->customFieldsType);
        self::assertSame('02.01.2023', $customField->createdAt->format('d.m.Y'));
        self::assertSame('02.01.2023 01:01:01', $customField->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $peopleApi = $this->getPeopleApi('',
            12345678);
        $result    = $peopleApi->customFields(2002)->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/people/12345678/custom_fields/2002', $peopleApi);
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
        $peopleApi = $this->getPeopleApi('',
            12345678);
        $result    = $peopleApi->customFields(2002)->delete();

        self::assertWebserviceUrl('https://www.example.org/people/12345678/custom_fields/2002', $peopleApi);
        self::assertHttpMethod('DELETE', $peopleApi);
        self::assertHttpHeaders($peopleApi);
        self::assertTrue($result);
    }
}
