<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Api\Actions\Protocols;

use Netresearch\Sdk\CentralStation\Api\AbstractApiEndpoint;
use Netresearch\Sdk\CentralStation\Collection\AttachmentsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Request\Attachments\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\Protocols\Attachments\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;

/**
 * The /protocols/<PROTOCOL-ID>/attachments endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments
 *     GET    https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments/<ATTACHMENT-ID>
 *     POST   https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments
 *     DELETE https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments/<ATTACHMENT-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractApiEndpoint<Model\Attachments, AttachmentsCollection>
 */
class Attachments extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'attachments';

    /**
     * Returns a list of all attachments assigned to a protocol.
     *
     * GET https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments
     *
     * @param IndexRequest $request The index request instance
     *
     * @return AttachmentsCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): AttachmentsCollection
    {
        return $this->findAllEntities(
            $request,
            Model\Attachments::class,
            AttachmentsCollection::class
        );
    }

    /**
     * Returns a single attachment assigned to a protocol. The route must contain the ID of the
     * attachment to be processed.
     *
     * GET https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments/<ATTACHMENT-ID>
     *
     * @return null|Model\Attachments
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Model\Attachments
    {
        return $this->findEntity(
            null,
            Model\Attachments::class
        );
    }

    /**
     * Creates a new attachment and returns it.
     *
     * POST https://<BASE-URL>/api/protocols/<PROTOCOL-ID>/attachments
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Model\Attachments
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Model\Attachments
    {
        return $this->createNewEntity(
            $request,
            Model\Attachments::class
        );
    }

    /**
     * The update method is not available for attachments.
     *
     * @param RequestInterface $request The update request instance
     *
     * @return bool
     *
     * @throws DetailedServiceException
     */
    public function update(RequestInterface $request): bool
    {
        throw new DetailedServiceException('Update not implemented for attachments');
    }
}
