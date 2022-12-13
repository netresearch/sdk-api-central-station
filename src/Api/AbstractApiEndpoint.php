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
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
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
 * @api
 *
 * @template TEntity
 * @template TEntityCollection
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
     * @template T
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
            // Do not remove, a ClientExceptionInterface maybe thrown in the sendRequest() method
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

    /**
     * Returns a list of all entities.
     *
     * @param RequestInterface                            $request             The index request instance
     * @param null|string|class-string<TEntity>           $className           The class name of the mapped response
     * @param null|string|class-string<TEntityCollection> $collectionClassName The collection class name of the
     *                                                                         mapped response
     *
     * @return TEntityCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function findAllEntities(
        RequestInterface $request,
        ?string $className,
        ?string $collectionClassName
    ) {
        $requestClosure = function () use ($request, $className, $collectionClassName) {
            $this->urlBuilder
                ->setParams($request->jsonSerialize());

            $response = $this->httpGet();

            return $this->serializer
                ->decode((string) $response->getBody(), $className, $collectionClassName);
        };

        return $this->execute($requestClosure);
    }

    /**
     * Returns a single entity. The route must contain the ID of the entity to be processed.
     *
     * @param null|RequestInterface        $request   The show request instance
     * @param string|class-string<TEntity> $className The class name of the mapped response
     *
     * @return null|TEntity
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function findEntity(?RequestInterface $request, string $className)
    {
        $requestClosure = function () use ($request, $className) {
            if ($request) {
                $this->urlBuilder->setParams($request->jsonSerialize());
            }

            $response = $this->httpGet();

            return $this->serializer
                ->decode((string) $response->getBody(), $className);
        };

        return $this->execute($requestClosure);
    }

    /**
     * Creates a new entity and returns it.
     *
     * @param RequestInterface             $request   The create request instance
     * @param string|class-string<TEntity> $className The class name of the mapped response
     *
     * @return null|TEntity
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    protected function createNewEntity(RequestInterface $request, string $className)
    {
        $requestClosure = function () use ($request, $className) {
            $response = $this->httpPost($request);

            return $this->serializer
                ->decode((string) $response->getBody(), $className);
        };

        return $this->execute($requestClosure);
    }

    /**
     * Updates an existing entity. The route must contain the ID of the entity to be processed.
     * Returns TRUE on success, FALSE otherwise.
     *
     * @param RequestInterface $request The update request instance
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function update(RequestInterface $request): bool
    {
        $requestClosure = function () use ($request): bool {
            return $this->httpPut($request)->getStatusCode() === 200;
        };

        return $this->execute($requestClosure);
    }

    /**
     * Deletes an existing entity. Returns TRUE on success, FALSE otherwise.
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function delete(): bool
    {
        $requestClosure = function (): bool {
            return $this->httpDelete()->getStatusCode() === 200;
        };

        return $this->execute($requestClosure);
    }
}
