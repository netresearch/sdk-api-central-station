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
use Netresearch\Sdk\CentralStation\Collection\TagsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Model\Tags\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\Tags\TagList as ListRequest;

/**
 * The /tags endpoint. Implements the following endpoints:
 *
 *     GET https://<BASE-URL>/api/tags
 *     GET https://<BASE-URL>/api/tags/<TAG-ID>
 *     GET https://<BASE-URL>/api/tags/list
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
     * Returns a list of all tags in an account.
     *
     * GET https://<BASE-URL>/api/tags
     *
     * @param IndexRequest $request The index request instance
     *
     * @return TagsCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): TagsCollection
    {
        return $this->findAll(
            $request,
            Model\Tags::class,
            TagsCollection::class
        );
    }

    /**
     * Returns a single tag. Requires a valid tag ID for the account.
     *
     * GET https://<BASE-URL>/api/tags/<TAG-ID>
     *
     * @return null|Tag
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Tag
    {
        $result = $this->findOne(
            null,
            Model\Tags::class
        );

        return $result ? ($result->tag ?? null) : null;
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
        $this->urlBuilder
            ->addPath('/list');

        return $this->findAll(
            $request,
            null,
            null
        );
    }
}
