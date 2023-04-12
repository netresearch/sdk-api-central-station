<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People\CustomFields;

use JsonException;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\CustomFields\CreateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\CustomFieldsProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class CreateRequestBuilderTest
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * @return string[][]
     */
    public static function createRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(CustomFieldsProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new address.
     *
     * @dataProvider createRequestDataProvider
     * @test
     *
     * @param string $expectedJson
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function create(string $expectedJson): void
    {
        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder
            ->setContent('MY-CUSTOM-FIELD-CONTENT')
            ->setCustomFieldsTypeId(1004);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }

    /**
     * @test
     */
    public function throwExceptionOnEmptyContent(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('Please provide the content of the custom field');

        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder->create();
    }

    /**
     * @test
     */
    public function throwExceptionOnEmptyCustomFieldsTypeId(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('Please provide the ID of the underlying custom fields type');

        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder
            ->setContent('MY-CUSTOM-FIELD-CONTENT')
            ->create();
    }
}
