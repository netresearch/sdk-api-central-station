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
use Netresearch\Sdk\CentralStation\Collection\ProtocolsCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\Protocols\Index as IndexRequest;

/**
 * The /people/<PERSON-ID>/protocols endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/protocols
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/protocols/<PROTOCOL-ID>
 *     POST   https://<BASE-URL>/api/people/<PERSON-ID>/protocols
 *     PUT    https://<BASE-URL>/api/people/<PERSON-ID>/protocols/<PROTOCOL-ID>
 *     DELETE https://<BASE-URL>/api/people/<PERSON-ID>/protocols/<PROTOCOL-ID>
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
     * Returns a list of all protocols assigned to a person.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/protocols
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
        return $this->findAll(
            $request,
            Model\Protocols::class,
            ProtocolsCollection::class
        );
    }

    /**
     * Returns a single protocol assigned to a person. The route must contain the ID of the protocol to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/protocols/<PROTOCOL-ID>
     *
     * @return null|Model\Protocols
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Model\Protocols
    {
        return $this->findOne(
            null,
            Model\Protocols::class
        );
    }

    /**
     * Creates a new protocol and returns it.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/protocols
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Model\Protocols
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Model\Protocols
    {
        return $this->createNew(
            $request,
            Model\Protocols::class
        );
    }
}
