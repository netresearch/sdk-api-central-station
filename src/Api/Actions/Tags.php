<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions;

use JsonException;
use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Collection\TagsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Tags\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\TagList as ListRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\Update as UpdateRequest;

/**
 * The /tags endpoint.
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
     * The index action can be used to query a list of all tags in an account.
     *
     * https://<BASE-URL>/api/tags.json
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
            ->addPath('.json')
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        return $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\Tags::class,
            TagsCollection::class
        );
    }

    /**
     * A single tag can be loaded with the show action. The prerequisite for this is
     * a valid tag ID for the account.
     *
     * https://<BASE-URL>/api/tags/<TAG-ID>.json
     *
     * @param ShowRequest $request The show request instance
     *
     * @return null|Tag
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function show(ShowRequest $request): ?Tag
    {
        $this->urlBuilder
            ->addPath('/' . $request->getTagId())
            ->addPath('.json')
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var null|\Netresearch\Sdk\CentralStation\Model\Tags $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\Tags::class
        );

        return $result ? ($result->tag ?? null) : null;
    }

    /**
     * This method creates a new tag. In the positive case, the system returns
     * the new tag. To create a new tag, the transfer of the name is mandatory. If the entry
     * could not be created because the account no longer has sufficient storage space for tags,
     * we return a 507 Insufficient Storage.
     *
     * @notice Creating an already existing tag results in a 422 (Unprocessable Entity) error exception.
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
        $this->urlBuilder
            ->addPath('.json');

        $response = $this->httpPost($request);

        /** @var null|\Netresearch\Sdk\CentralStation\Model\Tags $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\Tags::class
        );

        return $result ? ($result->tag ?? null) : null;
    }

    /**
     * The update works in the same way as the "create" action. The route must contain the ID of the
     * element to be processed. Returns TRUE on success, FALSE otherwise.
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
        $this->urlBuilder
            ->addPath('/' . $request->getTagId())
            ->addPath('.json');

        return $this->httpPut($request)->getStatusCode() === 200;
    }

    /**
     * This method is used to delete an element. Returns TRUE on success, FALSE otherwise.
     *
     * @param int $tagId A valid tag ID
     *
     * @return bool
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function delete(int $tagId): bool
    {
        $this->urlBuilder
            ->addPath('/' . $tagId)
            ->addPath('.json');

        return $this->httpDelete()->getStatusCode() === 200;
    }

    /**
     * Returns a list of all tag names in the account.
     *
     * @param ListRequest $request The list request instance
     *
     * @return string[]
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function list(ListRequest $request): array
    {
        $this->urlBuilder
            ->addPath('/list.json')
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        return $this->serializer->decode(
            (string) $response->getBody()
        );
    }
}
