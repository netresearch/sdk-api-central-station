<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation;

use Closure;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\Plugin\LoggerPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\Common\PluginClientFactory;
use Http\Discovery\Exception\NotFoundException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceExceptionFactory;
use Netresearch\Sdk\CentralStation\Http\ClientPlugin\ErrorPlugin;
use Netresearch\Sdk\CentralStation\Serializer\JsonSerializer;
use Psr\Log\LoggerInterface;

/**
 * The main API entry point.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class CentralStation
{
    /**
     * @var LoggerInterface
     */
    private readonly LoggerInterface $logger;

    /**
     * @var UrlBuilder
     */
    private readonly UrlBuilder $urlBuilder;

    /**
     * @var JsonSerializer
     */
    private readonly JsonSerializer $serializer;

    /**
     * The API key.
     *
     * @var string
     */
    private readonly string $apiKey;

    /**
     * Api instance for implementing lazy loading.
     *
     * @var Api|null
     */
    private ?Api $api = null;

    /**
     * CentralStation constructor.
     *
     * @param LoggerInterface    $logger        A logger instance
     * @param string             $webserviceUrl The URL of the webservice endpoint
     * @param string             $apiKey        The API key
     * @param string[]|Closure[] $classMap      A class map to override the default class names (source => target)
     */
    public function __construct(
        LoggerInterface $logger,
        string $webserviceUrl,
        string $apiKey,
        array $classMap = [],
    ) {
        $this->logger = $logger;
        $this->apiKey = $apiKey;

        $this->urlBuilder = new UrlBuilder();
        $this->urlBuilder
            ->setBase($webserviceUrl);

        $this->serializer = new JsonSerializer($classMap);
    }

    /**
     * Returns an instance of the http service factory.
     *
     * @return PluginClient
     *
     * @throws ServiceException
     */
    private function getHttpPluginClient(): PluginClient
    {
        try {
            $httpClient = Psr18ClientDiscovery::find();
        } catch (NotFoundException $exception) {
            throw ServiceExceptionFactory::create($exception);
        }

        return (new PluginClientFactory())->createClient(
            $httpClient,
            [
                new HeaderDefaultsPlugin([
                    'X-apikey'     => $this->apiKey,
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                ]),
                new LoggerPlugin($this->logger, new FullHttpMessageFormatter(null)),
                new ErrorPlugin(),
            ]
        );
    }

    /**
     * Returns the API by lazy loading.
     *
     * @return Api
     *
     * @throws ServiceException
     */
    public function api(): Api
    {
        if (!($this->api instanceof Api)) {
            try {
                $requestFactory = Psr17FactoryDiscovery::findRequestFactory();
                $streamFactory  = Psr17FactoryDiscovery::findStreamFactory();
            } catch (NotFoundException $exception) {
                throw ServiceExceptionFactory::create($exception);
            }

            $this->api = new Api(
                $this->getHttpPluginClient(),
                $requestFactory,
                $streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->api;
    }
}
