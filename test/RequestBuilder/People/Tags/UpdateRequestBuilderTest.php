<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Tags;

use Netresearch\Sdk\CentralStation\RequestBuilder\People\Tags\UpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\Tags\UpdateProvider;
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
                file_get_contents(UpdateProvider::updateRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests updating an existing tag.
     *
     * @dataProvider updateRequestDataProvider
     * @test
     *
     * @param string $expectedJson
     */
    public function update(string $expectedJson): void
    {
        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder->setTagName('Updated tag');

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }
}
