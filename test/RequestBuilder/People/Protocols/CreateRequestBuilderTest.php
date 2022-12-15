<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People\Protocols;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\Protocols\CreateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\People\Protocols\CreateProvider;
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
    public function createRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(CreateProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new protocol.
     *
     * @dataProvider createRequestDataProvider
     * @test
     *
     * @param string $expectedJson
     */
    public function create(string $expectedJson): void
    {
        $requestBuilder = new CreateRequestBuilder();
        $requestBuilder->setName('Protocol name')
            ->setContent('Protocol content')
            ->setConfidential(true)
            ->setBadge(Constants::PROTOCOL_BADGE_MEETING)
            ->setFormat(Constants::PROTOCOL_FORMAT_PLAINTEXT);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }
}
