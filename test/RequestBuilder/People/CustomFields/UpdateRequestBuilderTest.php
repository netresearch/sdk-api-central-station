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
use Netresearch\Sdk\CentralStation\RequestBuilder\People\CustomFields\UpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\CustomFieldsProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class UpdateRequestBuilderTest
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * @return string[][]
     */
    public function updateRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(CustomFieldsProvider::updateRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests updating an existing address.
     *
     * @dataProvider updateRequestDataProvider
     * @test
     *
     * @param string $expectedJson
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function update(string $expectedJson): void
    {
        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder
            ->setContent('MY-CUSTOM-FIELD-CONTENT-UPDATED');


        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }

    /**
     * Tests throwing an exception if no data to update is provided.
     *
     * @test
     */
    public function throwExceptionIfEmpty(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('Please provide at least one value to update');

        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder->create();
    }
}
