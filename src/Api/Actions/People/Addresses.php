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
use Netresearch\Sdk\CentralStation\Collection\AddressesCollection;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model;
use Netresearch\Sdk\CentralStation\Model\Addresses\Address;
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
 * @api
 */
class Addresses extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'addrs';

    /**
     * Returns a list of all addrs assigned to a person.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/addrs
     *
     * @return AddressesCollection
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(): AddressesCollection
    {
        return $this->findAllEntities(
            null,
            Model\Addresses::class,
            AddressesCollection::class
        );
    }

    /**
     * Returns a single tag assigned to a person. The route must contain the ID of the tag to be processed.
     *
     * GET https://<BASE-URL>/api/people/<PERSON-ID>/addrs/<ADDRESS-ID>
     *
     * @return null|Address
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(): ?Address
    {
        $result = $this->findEntity(
            null,
            Model\Addresses::class
        );

        return $result ? ($result->addr ?? null) : null;
    }

    /**
     * Creates a new tag and returns it.
     *
     * POST https://<BASE-URL>/api/people/<PERSON-ID>/addrs
     *
     * @param CreateRequest $request The create request instance
     *
     * @return null|Address
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function create(CreateRequest $request): ?Address
    {
        $result = $this->createNewEntity(
            $request,
            Model\Addresses::class
        );

        return $result ? ($result->addr ?? null) : null;
    }
}
