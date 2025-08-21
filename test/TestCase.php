<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test;

use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Http\Mock\Client;
use Netresearch\Sdk\CentralStation\Api;
use Netresearch\Sdk\CentralStation\Api\EndpointInterface;
use Netresearch\Sdk\CentralStation\CentralStation;
use Netresearch\Sdk\CentralStation\Http\ClientPlugin\ErrorPlugin;
use Netresearch\Sdk\CentralStation\Serializer\JsonSerializer;
use Netresearch\Sdk\CentralStation\UrlBuilder;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\NullLogger;
use ReflectionException;
use ReflectionObject;

/**
 * Class TestCase.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Returns a mocked service factory instance return the given file as response if the request is sent.
     *
     * @param string $responseData
     * @param int    $statusCode
     *
     * @return CentralStation|MockObject
     */
    public function getServiceFactoryMock(string $responseData = '', int $statusCode = 200): MockObject|CentralStation
    {
        // Response
        if ($responseData !== '') {
            $stream = Psr17FactoryDiscovery::findStreamFactory()
                ->createStreamFromFile($responseData);
        } else {
            $stream = Psr17FactoryDiscovery::findStreamFactory()
                ->createStream('');
        }

        $response = (new Response())
            ->withStatus($statusCode)
            ->withBody($stream);

        // Client mock
        $httpClientMock = new Client();
        $httpClientMock->addResponse($response);

        $httpPluginClient = (new PluginClientFactory())->createClient(
            $httpClientMock,
            [
                new HeaderDefaultsPlugin([
                    'X-apikey'     => 'TOTALLY-SECRET-API-KEY',
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ]),
                new LoggerPlugin(new NullLogger(), new FullHttpMessageFormatter(null)),
                new ErrorPlugin(),
            ]
        );

        $urlBuilder = new UrlBuilder();
        $urlBuilder->setBase('https://www.example.org');

        $api = new Api(
            $httpPluginClient,
            Psr17FactoryDiscovery::findRequestFactory(),
            Psr17FactoryDiscovery::findStreamFactory(),
            new JsonSerializer(),
            $urlBuilder
        );

        $serviceFactoryMock = $this
            ->getMockBuilder(CentralStation::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'api',
            ])
            ->getMock();

        $serviceFactoryMock
            ->expects(self::once())
            ->method('api')
            ->willReturn($api);

        return $serviceFactoryMock;
    }

    /**
     * Asserts that given $actual is a valid webservice endpoint with a valid URL.
     *
     * @param string            $expected
     * @param EndpointInterface $actual
     * @param string            $message
     *
     * @return void
     */
    public static function assertWebserviceUrl(string $expected, EndpointInterface $actual, string $message = ''): void
    {
        $reflection = new ReflectionObject($actual);

        try {
            $urlBuilderProperty = $reflection->getProperty('urlBuilder');

            /** @var UrlBuilder $urlBuilder */
            $urlBuilder = $urlBuilderProperty->getValue($actual);

            self::assertSame($expected, $urlBuilder->getFullUrl(), $message);
        } catch (ReflectionException) {
            self::fail('Reflection failed');
        }
    }

    /**
     * Asserts that given $actual matches the $expected HTTP method.
     *
     * @param string            $expected
     * @param EndpointInterface $actual
     * @param string            $message
     *
     * @return void
     */
    public static function assertHttpMethod(string $expected, EndpointInterface $actual, string $message = ''): void
    {
        $reflection = new ReflectionObject($actual);

        try {
            $clientProperty = $reflection->getProperty('client');

            /** @var PluginClient $pluginClient */
            $pluginClient = $clientProperty->getValue($actual);

            $reflection     = new ReflectionObject($pluginClient);
            $clientProperty = $reflection->getProperty('client');

            /** @var Client $mockClient */
            $mockClient = $clientProperty->getValue($pluginClient);

            self::assertSame($expected, $mockClient->getLastRequest()->getMethod(), $message);
        } catch (ReflectionException) {
            self::fail('Reflection failed');
        }
    }

    /**
     * Asserts that the client performs the request with required HTTP headers.
     *
     * @param EndpointInterface $actual
     * @param string            $message
     *
     * @return void
     */
    public static function assertHttpHeaders(EndpointInterface $actual, string $message = ''): void
    {
        try {
            $reflection     = new ReflectionObject($actual);
            $clientProperty = $reflection->getProperty('client');

            /** @var PluginClient $pluginClient */
            $pluginClient = $clientProperty->getValue($actual);

            $reflection     = new ReflectionObject($pluginClient);
            $clientProperty = $reflection->getProperty('client');

            /** @var Client $mockClient */
            $mockClient = $clientProperty->getValue($pluginClient);

            self::assertSame(
                'application/json',
                $mockClient->getLastRequest()->getHeaderLine('Accept'),
                $message
            );

            self::assertSame(
                'TOTALLY-SECRET-API-KEY',
                $mockClient->getLastRequest()->getHeaderLine('X-apikey'),
                $message
            );
        } catch (ReflectionException) {
            self::fail('Reflection failed');
        }
    }

    /**
     * Asserts that a variable is instance of or null.
     *
     * @param string $expected
     * @param        $actual
     * @param string $message
     */
    public static function assertIsNullOrInstanceOf(string $expected, mixed $actual, string $message = ''): void
    {
        self::assertThat(
            $actual,
            self::logicalOr(
                self::isInstanceOf($expected),
                self::isNull()
            ),
            $message
        );
    }

    /**
     * Asserts that a variable is of type array or null.
     *
     * @param        $actual
     * @param string $message
     */
    public static function assertIsNullOrArray(mixed $actual, string $message = ''): void
    {
        self::assertThat(
            $actual,
            self::logicalOr(
                self::isType(IsType::TYPE_ARRAY),
                self::isNull()
            ),
            $message
        );
    }

    /**
     * Asserts that a variable is of type bool or null.
     *
     * @param        $actual
     * @param string $message
     */
    public static function assertIsNullOrBool(mixed $actual, string $message = ''): void
    {
        self::assertThat(
            $actual,
            self::logicalOr(
                self::isType(IsType::TYPE_BOOL),
                self::isNull()
            ),
            $message
        );
    }

    /**
     * Asserts that a variable is of type int or null.
     *
     * @param        $actual
     * @param string $message
     */
    public static function assertIsNullOrInt(mixed $actual, string $message = ''): void
    {
        self::assertThat(
            $actual,
            self::logicalOr(
                self::isType(IsType::TYPE_INT),
                self::isNull()
            ),
            $message
        );
    }

    /**
     * Asserts that a variable is of type float or null.
     *
     * @param        $actual
     * @param string $message
     */
    public static function assertIsNullOrFloat(mixed $actual, string $message = ''): void
    {
        self::assertThat(
            $actual,
            self::logicalOr(
                self::isType(IsType::TYPE_FLOAT),
                self::isNull()
            ),
            $message
        );
    }

    /**
     * Asserts that a variable is of type string or null.
     *
     * @param        $actual
     * @param string $message
     */
    public static function assertIsNullOrString(mixed $actual, string $message = ''): void
    {
        self::assertThat(
            $actual,
            self::logicalOr(
                self::isType(IsType::TYPE_STRING),
                self::isNull()
            ),
            $message
        );
    }
}
