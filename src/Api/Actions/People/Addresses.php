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
use Netresearch\Sdk\CentralStation\Model\Address;
use Netresearch\Sdk\CentralStation\Model\Container\AddressContainer;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\AddressContainerCollection;
use Netresearch\Sdk\CentralStation\Request\People\Addresses\Create as CreateRequest;

/**
 * The /people/<PERSON-ID>/addrs endpoint. Implements the following endpoints:
 *
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/addrs
 *     GET    https://<BASE-URL>/api/people/<PERSON-ID>/addrs/<ADDRESS-ID>
 *     POST   https://<BASE-URL>/api/people/<PERSON-ID>/addrs
 *     PUT    https://<BASE-URL>/api/people/<PERSON-ID>/addrs/<ADDRESS-ID>
 *     DELETE https://<BASE-URL>/api/people/<PERSON-ID>/addrs/<ADDRESS-ID>
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 *
 * @extends AbstractApiEndpoint<AddressContainer, AddressContainerCollection>
 */
class Addresses extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    final public const PATH = 'addrs';

    /**
     * Returns a list of all addrs assigned to a person.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/addrs
     *
     * @return AddressContainerCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(): AddressContainerCollection
    {
        return $this->findAllEntities(
            null,
            AddressContainer::class,
            AddressContainerCollection::class
        );
    }

    /**
     * Returns a single tag assigned to a person. The route must contain the ID of the tag to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/addrs/<ADDRESS-ID>
     *
     * @return Address|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Address
    {
        $result = $this->findEntity(
            null,
            AddressContainer::class
        );

        return ($result instanceof AddressContainer) ? ($result->addr ?? null) : null;
    }

    /**
     * Creates a new tag and returns it.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/addrs
     *
     * @param CreateRequest $request The create request instance
     *
     * @return Address|null
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Address
    {
        $result = $this->createNewEntity(
            $request,
            AddressContainer::class
        );

        return ($result instanceof AddressContainer) ? ($result->addr ?? null) : null;
    }
}
