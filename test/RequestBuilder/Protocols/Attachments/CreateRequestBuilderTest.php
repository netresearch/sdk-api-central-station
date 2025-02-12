<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder\Protocols\Attachments;

use JsonException;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\RequestBuilder\Protocols\Attachments\CreateRequestBuilder;
use Netresearch\Sdk\CentralStation\Test\Provider\Protocols\AttachmentsProvider;
use Netresearch\Sdk\CentralStation\Test\RequestBuilder\RequestBuilderTestCase;

/**
 * Class CreateRequestBuilderTest.
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
                file_get_contents(AttachmentsProvider::createRequest()) ?: '',
            ],
        ];
    }

    /**
     * Tests creating a new attachment.
     *
     * @dataProvider createRequestDataProvider
     *
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
        $requestBuilder->setFilename('uploaded-file.png')
            ->setContentType('image/png')
            ->setData(base64_encode('BASE64 ENCODED FILE CONTENT'));

        $request     = $requestBuilder->create();
        $requestJson = $this->serializer->encode($request);

        self::assertSameJson($expectedJson, $requestJson);
    }
}
