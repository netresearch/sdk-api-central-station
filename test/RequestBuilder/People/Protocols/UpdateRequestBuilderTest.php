<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People\Protocols;

use JsonException;
use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\Protocols\UpdateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\ProtocolsProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class UpdateRequestBuilderTest.
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
    public static function updateRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(ProtocolsProvider::updateRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests updating an existing protocol.
     *
     * @dataProvider updateRequestDataProvider
     *
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
        $requestBuilder->setName('Protocol name')
            ->setContent('Protocol content')
            ->setConfidential(true)
            ->setBadge(Constants::PROTOCOL_BADGE_MEETING)
            ->setFormat(Constants::PROTOCOL_FORMAT_PLAINTEXT);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }

    /**
     * @test
     */
    public function throwExceptionOnUnsupportedFormat(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('The provided format parameter "UPDATED-FORMAT" is not allowed');

        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder
            ->setFormat('UPDATED-FORMAT')
            ->create();
    }

    /**
     * @test
     */
    public function throwExceptionOnUnsupportedBadge(): void
    {
        $this->expectException(RequestValidatorException::class);
        $this->expectExceptionMessage('The provided badge parameter "UPDATED-BADGE" is not allowed');

        $requestBuilder = new UpdateRequestBuilder();
        $requestBuilder
            ->setFormat(Constants::PROTOCOL_FORMAT_HTML)
            ->setBadge('UPDATED-BADGE')
            ->create();
    }
}
