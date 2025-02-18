<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\People;

use JsonException;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\People\MergeRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\PeopleProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class MergeRequestBuilderTest.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class MergeRequestBuilderTest extends RequestBuilderTestCase
{
    /**
     * @return string[][]
     */
    public static function mergeRequestDataProvider(): array
    {
        return [
            'Request' => [
                file_get_contents(PeopleProvider::mergeRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests updating an existing person.
     *
     * @dataProvider mergeRequestDataProvider
     *
     * @test
     *
     * @param string $expectedJson
     *
     * @throws RequestValidatorException
     * @throws JsonException
     */
    public function merge(string $expectedJson): void
    {
        $requestBuilder = new MergeRequestBuilder();
        $requestBuilder
            ->setPersonId(1)
            ->addPersonToMerge(5)
            ->addPersonToMerge(10)
            ->addPersonToMerge(100);

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }
}
