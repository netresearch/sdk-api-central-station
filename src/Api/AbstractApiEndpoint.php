<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api;

use Closure;
use JsonException;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationErrorException;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedErrorException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceExceptionFactory;
use Netresearch\Sdk\CentralStation\Serializer\JsonSerializer;
use Netresearch\Sdk\CentralStation\UrlBuilder;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Throwable;

/**
 * An abstract class for each API endpoint, containing the methods which performs
 * the actual request/response handling.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
abstract class AbstractApiEndpoint implements EndpointInterface
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    protected $streamFactory;

    /**
     * The JSON serializer instance.
     *
     * @var JsonSerializer
     */
    protected $serializer;

    /**
     * @var UrlBuilder
     */
    protected $urlBuilder;

    /**
     * Constructor.
     *
     * @param ClientInterface         $client
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param JsonSerializer          $jsonSerializer
     * @param UrlBuilder              $urlBuilder
     */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        JsonSerializer $jsonSerializer,
        UrlBuilder $urlBuilder
    ) {
        $this->client         = $client;
        $this->requestFactory = $requestFactory;
        $this->streamFactory  = $streamFactory;
        $this->serializer     = $jsonSerializer;
        $this->urlBuilder     = $urlBuilder;
    }

    /**
     * Executes the given closure and returns the response result.
     *
     * @template T of object
     *
     * @param Closure(): T $requestClosure The closure to execute
     *
     * @return T
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function execute(Closure $requestClosure)
    {
        try {
            return $requestClosure();
        } catch (AuthenticationErrorException $exception) {
            throw ServiceExceptionFactory::createAuthenticationException($exception);
        } catch (DetailedErrorException $exception) {
            throw ServiceExceptionFactory::createDetailedServiceException($exception);
        } catch (ClientExceptionInterface $exception) {
            // Do not remove, a ClientExceptionInterface maybe thrown sendRequest() method
            throw ServiceExceptionFactory::createServiceException($exception);
        } catch (Throwable $exception) {
            throw ServiceExceptionFactory::create($exception);
        }
    }

    /**
     * Perform a GET request.
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface
     */
    protected function httpGet(): ResponseInterface
    {
        $request = $this->requestFactory
            ->createRequest('GET', $this->urlBuilder->getFullUrl());

        return $this->client->sendRequest($request);
    }

    /**
     * Perform a POST request.
     *
     * @param RequestInterface $requestType The API request instance
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    protected function httpPost(RequestInterface $requestType): ResponseInterface
    {
        $encodedBody = $this->serializer->encode($requestType);

        $request = $this->requestFactory
            ->createRequest('POST', $this->urlBuilder->getFullUrl())
            ->withBody($this->streamFactory->createStream($encodedBody));

        return $this->client->sendRequest($request);
    }

    /**
     * Perform a PUT request.
     *
     * @param RequestInterface $requestType The API request instance
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    protected function httpPut(RequestInterface $requestType): ResponseInterface
    {
        $encodedBody = $this->serializer->encode($requestType);

        $request = $this->requestFactory
            ->createRequest('PUT', $this->urlBuilder->getFullUrl())
            ->withBody($this->streamFactory->createStream($encodedBody));

        return $this->client->sendRequest($request);
    }

    /**
     * Perform a DELETE request.
     *
     * @return ResponseInterface
     *
     * @throws ClientExceptionInterface
     */
    protected function httpDelete(): ResponseInterface
    {
        $request = $this->requestFactory
            ->createRequest('DELETE', $this->urlBuilder->getFullUrl());

        return $this->client->sendRequest($request);
    }
}
