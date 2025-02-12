<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions;

use Netresearch\Sdk\CentralStation\Api\Actions\CustomFieldsTypes;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\CustomFieldsTypeContainer;
use Netresearch\Sdk\CentralStation\Model\CustomFieldsType;
use Netresearch\Sdk\CentralStation\Test\Provider\CustomFieldsTypesProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class CustomFieldsTypesTest.
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CustomFieldsTypesTest extends TestCase
{
    /**
     * Returns an instance of the custom fields types API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $customFieldsTypesId
     *
     * @return CustomFieldsTypes
     *
     * @throws ServiceException
     */
    private function getCustomFieldsTypesApi(
        string $responseJsonFile = '',
        ?int $customFieldsTypesId = null,
    ): CustomFieldsTypes {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->customFieldsTypes($customFieldsTypesId);
    }

    /**
     * @return string[][]
     */
    public static function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                CustomFieldsTypesProvider::indexResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "index" method.
     *
     * @dataProvider indexResponseDataProvider
     *
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
        $customFieldsTypesApi = $this->getCustomFieldsTypesApi($responseJsonFile);
        $result               = $customFieldsTypesApi->index();

        self::assertWebserviceUrl('https://www.example.org/custom_fields_types', $customFieldsTypesApi);
        self::assertHttpMethod('GET', $customFieldsTypesApi);
        self::assertHttpHeaders($customFieldsTypesApi);
        self::assertContainsOnlyInstancesOf(CustomFieldsTypeContainer::class, $result);

        foreach ($result as $customFieldsTypes) {
            self::assertInstanceOf(CustomFieldsTypeContainer::class, $customFieldsTypes);
            self::assertInstanceOf(CustomFieldsType::class, $customFieldsTypes->customFieldsType);
        }

        self::assertFirstCustomFieldsType($result->offsetGet(0)->customFieldsType);
        self::assertSecondCustomFieldsType($result->offsetGet(1)->customFieldsType);
    }

    /**
     * Asserts that the data of the given element matches the expected values.
     *
     * @param CustomFieldsType $customFieldsType
     *
     * @return void
     */
    private static function assertFirstCustomFieldsType(CustomFieldsType $customFieldsType): void
    {
        self::assertSame(1000, $customFieldsType->id);
        self::assertSame(10000, $customFieldsType->accountId);
        self::assertSame(1, $customFieldsType->position);
        self::assertFalse($customFieldsType->visibleForAllGroups);
        self::assertSame('Person', $customFieldsType->category);
        self::assertSame('string', $customFieldsType->type);
        self::assertSame('CUSTOM-FIELD-TYPE-STRING', $customFieldsType->name);
        self::assertSame([], $customFieldsType->options);
        self::assertFalse($customFieldsType->apiOnly);
        self::assertSame('01.01.2023', $customFieldsType->createdAt->format('d.m.Y'));
        self::assertSame('01.01.2023 01:01:01', $customFieldsType->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given element matches the expected values.
     *
     * @param CustomFieldsType $customFieldsType
     *
     * @return void
     */
    private static function assertSecondCustomFieldsType(CustomFieldsType $customFieldsType): void
    {
        self::assertSame(1001, $customFieldsType->id);
        self::assertSame(10000, $customFieldsType->accountId);
        self::assertSame(2, $customFieldsType->position);
        self::assertFalse($customFieldsType->visibleForAllGroups);
        self::assertSame('Person', $customFieldsType->category);
        self::assertSame('select', $customFieldsType->type);
        self::assertSame('CUSTOM-FIELD-TYPE-SELECT', $customFieldsType->name);
        self::assertSame(['Option-1', 'Option-2', 'Option-3'], $customFieldsType->options);
        self::assertFalse($customFieldsType->apiOnly);
        self::assertSame('01.01.2023', $customFieldsType->createdAt->format('d.m.Y'));
        self::assertSame('01.01.2023 01:01:01', $customFieldsType->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public static function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                CustomFieldsTypesProvider::showResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "show" method.
     *
     * @dataProvider showResponseDataProvider
     *
     * @test
     *
     * @param string $responseJsonFile
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(string $responseJsonFile): void
    {
        $customFieldsTypesApi = $this->getCustomFieldsTypesApi($responseJsonFile, 1000);
        $result               = $customFieldsTypesApi->show();

        self::assertWebserviceUrl('https://www.example.org/custom_fields_types/1000', $customFieldsTypesApi);
        self::assertHttpMethod('GET', $customFieldsTypesApi);
        self::assertHttpHeaders($customFieldsTypesApi);
        self::assertInstanceOf(CustomFieldsType::class, $result);

        self::assertFirstCustomFieldsType($result);
    }
}
