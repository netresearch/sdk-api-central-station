<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions;

use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\TagContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\TagContainer;
use Netresearch\Sdk\CentralStation\Model\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\TagList as ListRequest;

/**
 * The /tags endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/tags
 *     GET    https://<BASE-URL>/api/tags/<TAG-ID>
 *     PUT    https://<BASE-URL>/api/tags/<TAG-ID>
 *     DELETE https://<BASE-URL>/api/tags/<TAG-ID>
 *     GET    https://<BASE-URL>/api/tags/list
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class Tags extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'tags';

    /**
     * Returns a list of all tags in an account.
     *
     * GET https://<BASE-URL>/api/tags
     *
     * @param IndexRequest $request The index request instance
     *
     * @return TagContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): TagContainerCollection
    {
        return $this->findAllEntities(
            $request,
            TagContainer::class,
            TagContainerCollection::class
        );
    }

    /**
     * Returns a single tag. Requires a valid tag ID for the account.
     *
     * GET https://<BASE-URL>/api/tags/<TAG-ID>
     *
     * @return Tag|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Tag
    {
        $result = $this->findEntity(
            null,
            TagContainer::class
        );

        return ($result instanceof TagContainer) ? ($result->tag ?? null) : null;
    }

    /**
     * Returns a list of all tag names in the account.
     *
     * GET https://<BASE-URL>/api/tags/list
     *
     * @param ListRequest $request The list request instance
     *
     * @return string[]
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function list(ListRequest $request): array
    {
        $requestClosure = function () use ($request): mixed {
            $this->urlBuilder
                ->addPath('/list')
                ->setParams($request->jsonSerialize());

            $response = $this->httpGet();

            return $this->serializer
                ->decode((string) $response->getBody());
        };

        return $this->execute($requestClosure);
    }
}
