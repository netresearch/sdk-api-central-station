<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions\People;

use JsonException;
use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Collection\TagsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Tags\Tag;
use Netresearch\Sdk\CentralStation\Request\People\Tags\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\People\Tags\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\Index as IndexRequest;

/**
 * The /people/<PERSON-ID>/tags endpoint.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class Tags extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'tags';

    /**
     * Returns a list of all tags assigned to a person.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID/tags
     *
     * @param IndexRequest $request The index request instance
     *
     * @return TagsCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function index(IndexRequest $request): TagsCollection
    {
        $this->urlBuilder
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        return $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\Tags::class,
            TagsCollection::class
        );
    }

    /**
     * Returns a single tag assigned to a person. The route must contain the ID of the tag to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
     *
     * @return null|Tag
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function show(): ?Tag
    {
        $response = $this->httpGet();

        /** @var null|\Netresearch\Sdk\CentralStation\Model\Tags $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\Tags::class
        );

        return $result ? ($result->tag ?? null) : null;
    }

    /**
     * Creates a new tag and returns the newly created element.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Tag
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function create(CreateRequest $request): ?Tag
    {
        $response = $this->httpPost($request);

        /** @var null|\Netresearch\Sdk\CentralStation\Model\Tags $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\Tags::class
        );

        return $result ? ($result->tag ?? null) : null;
    }

    /**
     * Updates an existing tag. The route must contain the ID of the element to be processed.
     * Returns TRUE on success, FALSE otherwise.
     *
     * PUT https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
     *
     * @param UpdateRequest $request The update request instance
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function update(UpdateRequest $request): bool
    {
        return $this->httpPut($request)->getStatusCode() === 200;
    }

    /**
     * Deletes an existing tag. Returns TRUE on success, FALSE otherwise.
     *
     * DELETE https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function delete(): bool
    {
        return $this->httpDelete()->getStatusCode() === 200;
    }
}
