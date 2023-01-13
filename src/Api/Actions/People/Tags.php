<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions\People;

use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\TagContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\TagContainer;
use Netresearch\Sdk\CentralStation\Model\Tag;
use Netresearch\Sdk\CentralStation\Request\People\Tags\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\Index as IndexRequest;

/**
 * The /people/<PERSON-ID>/tags endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/tags
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
 *     POST   https://<BASE-URL>/api/people/<PERSON-ID>/tags
 *     PUT    https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
 *     DELETE https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
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
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/tags
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
     * Returns a single tag assigned to a person. The route must contain the ID of the tag to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/tags/<TAG-ID>
     *
     * @return null|Tag
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

        return $result ? ($result->tag ?? null) : null;
    }

    /**
     * Creates a new tag and returns it.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/tags
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Tag
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Tag
    {
        $result = $this->createNewEntity(
            $request,
            TagContainer::class
        );

        return $result ? ($result->tag ?? null) : null;
    }
}
