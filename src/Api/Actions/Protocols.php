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
use Netresearch\Sdk\CentralStation\Collection\ProtocolsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Request\Protocols\Index as IndexRequest;

/**
 * The /protocols endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/protocols
 *     GET    https://<BASE-URL>/api/protocols/<PROTOCOL-ID>
 *     PUT    https://<BASE-URL>/api/protocols/<PROTOCOL-ID>
 *     DELETE https://<BASE-URL>/api/protocols/<PROTOCOL-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @extends AbstractApiEndpoint<Model\Protocols, ProtocolsCollection>
 */
class Protocols extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'protocols';

    /**
     * Instance of the "attachments" API for implementing lazy loading.
     *
     * @var null|Protocols\Attachments
     */
    private $attachmentsApi;

    /**
     * Returns the "attachments" API used to process attachments related to a specific person.
     *
     * @param null|string $attachmentId A valid attachment ID
     *
     * @return Protocols\Attachments
     */
    public function attachments(string $attachmentId = null): Protocols\Attachments
    {
        $this->urlBuilder
            ->setParams([])
            ->addPath('/' . Protocols\Attachments::PATH);

        // Add attachment ID if available
        if ($attachmentId) {
            $this->urlBuilder
                ->addPath('/' . $attachmentId);
        }

        if (!$this->attachmentsApi) {
            $this->attachmentsApi = new Protocols\Attachments(
                $this->client,
                $this->requestFactory,
                $this->streamFactory,
                $this->serializer,
                $this->urlBuilder
            );
        }

        return $this->attachmentsApi;
    }

    /**
     * Returns a list of all protocols in an account.
     *
     * GET https://<BASE-URL>/api/protocols
     *
     * @param IndexRequest $request The index request instance
     *
     * @return ProtocolsCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): ProtocolsCollection
    {
        return $this->findAllEntities(
            $request,
            Model\Protocols::class,
            ProtocolsCollection::class
        );
    }

    /**
     * Returns a single protocol. Requires a valid protocol ID for the account.
     *
     * GET https://<BASE-URL>/api/protocols/<PROTOCOL-ID>
     *
     * @return null|Model\Protocols
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Model\Protocols
    {
        return $this->findEntity(
            null,
            Model\Protocols::class
        );
    }
}
