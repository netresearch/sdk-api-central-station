<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Http\ClientPlugin;

use Http\Client\Common\Exception\ClientErrorException;
use Http\Client\Common\Exception\ServerErrorException;
use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use JsonException;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationErrorException;
use Netresearch\Sdk\CentralStation\Exception\DetailedErrorException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ErrorPlugin
 *
 * On request errors, throw an HTTP exception with message extracted from response.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
final class ErrorPlugin implements Plugin
{
    /**
     * HTTP response codes.
     */
    private const HTTP_BAD_REQUEST            = 400;
    private const HTTP_UNAUTHORIZED           = 401;
    private const HTTP_FORBIDDEN              = 403;
    private const HTTP_CONFLICT               = 409;
    private const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
    private const HTTP_UNPROCESSABLE_ENTITY   = 422;
    private const HTTP_INTERNAL_SERVER_ERROR  = 500;
    private const HTTP_INSUFFICIENT_STORAGE   = 507;

    /**
     * Handles all client/server errors.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @throws AuthenticationErrorException
     * @throws DetailedErrorException
     * @throws ClientErrorException
     * @throws ServerErrorException
     */
    private function handleError(RequestInterface $request, ResponseInterface $response): void
    {
        // Status code >= 500
        if ($response->getStatusCode() >= self::HTTP_INTERNAL_SERVER_ERROR) {
            // Insufficient storage
            if ($response->getStatusCode() === self::HTTP_INSUFFICIENT_STORAGE) {
                throw new ServerErrorException(
                    'The request could not be processed because the account does not have enough storage '
                    . 'space (e.g. contacts, offers & projects or storage space).',
                    $request,
                    $response
                );
            }

            // Every other 5xx error
            throw new ServerErrorException($response->getReasonPhrase(), $request, $response);
        }

        // Not authorized
        if ($response->getStatusCode() === self::HTTP_UNAUTHORIZED) {
            throw new AuthenticationErrorException(
                'Authentication failed. Please check your API key.',
                $request,
                $response
            );
        }

        // Forbidden
        if ($response->getStatusCode() === self::HTTP_FORBIDDEN) {
            throw new DetailedErrorException(
                'The specified user does not have sufficient rights for the action.',
                $request,
                $response
            );
        }

        // Conflict
        if ($response->getStatusCode() === self::HTTP_CONFLICT) {
            throw new DetailedErrorException(
                'The request was made under false assumptions. For example, if the resource has '
                . 'been changed in the meantime.',
                $request,
                $response
            );
        }

        // Unsupported media type
        if ($response->getStatusCode() === self::HTTP_UNSUPPORTED_MEDIA_TYPE) {
            throw new DetailedErrorException(
                'The content of the request was submitted with an invalid or not allowed media type. '
                . 'Only .json is supported.',
                $request,
                $response
            );
        }

        // Unprocessable entity
        if ($response->getStatusCode() === self::HTTP_UNPROCESSABLE_ENTITY) {
            try {
                $errorResponse = json_decode(
                    (string)$response->getBody(),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );
            } catch (JsonException $exception) {
                throw new ClientErrorException($response->getReasonPhrase(), $request, $response);
            }

            $errorKey   = key($errorResponse);
            $errorValue = current($errorResponse);

            $errorMessage = sprintf(
                'The entity "%s" failed with "%s".',
                $errorKey,
                is_array($errorValue) ? implode('" or "', $errorValue) : $errorValue
            );

            throw new DetailedErrorException(
                $errorMessage,
                $request,
                $response
            );
        }

        // Every other 4xx error
        throw new ClientErrorException($response->getReasonPhrase(), $request, $response);
    }

    /**
     * Handle the request and return the response coming from the next callable.
     *
     * @param RequestInterface $request The request
     * @param callable         $next    Next middleware in the chain, the request is passed as the first argument
     * @param callable         $first   First middleware in the chain, used to restart a request
     *
     * @return Promise Resolves a PSR-7 Response or fails with a Http\Client\Exception (The same as HttpAsyncClient).
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first): Promise
    {
        /** @var Promise $promise */
        $promise = $next($request);

        $fnFulfilled = function (ResponseInterface $response) use ($request) {
            $statusCode = $response->getStatusCode();

            // Handle errors
            if ($statusCode >= self::HTTP_BAD_REQUEST) {
                $this->handleError($request, $response);
            }

            // No error
            return $response;
        };

        return $promise->then($fnFulfilled);
    }
}
