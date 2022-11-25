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
use Netresearch\Sdk\CentralStation\Collection\PeopleCollection;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\People\Person;
use Netresearch\Sdk\CentralStation\Request\People\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\People\Show as ShowRequest;

/**
 * The /people endpoint.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class People extends AbstractApiEndpoint
{
    /**
     * The relative URL path.
     *
     * @var string
     */
    public const PATH = 'people';

    /**
     * The index action can be used to query a list of all people in an account.
     *
     * @param IndexRequest $request The index request instance
     *
     * @return PeopleCollection
     *
     * @throws DetailedServiceException
     * @throws JsonException
     * @throws ServiceException
     */
    public function index(IndexRequest $request): PeopleCollection
    {
        $this->urlBuilder
            ->addPath('.json')
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var PeopleCollection $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class,
            PeopleCollection::class
        );

        return $result;
    }

    /**
     * A single person can be loaded with the show action. The prerequisite for this is
     * a valid personal ID for the account.
     *
     * @param ShowRequest $request The show request instance
     *
     * @return null|Person
     *
     * @throws DetailedServiceException
     * @throws ServiceException
     * @throws JsonException
     */
    public function show(
        ShowRequest $request
    ): ?Person {
        $this->urlBuilder
            ->addPath('/' . $request->getPersonId() . '.json')
            ->setParams($request->jsonSerialize());

        $response = $this->httpGet();

        /** @var null|\Netresearch\Sdk\CentralStation\Model\People $result */
        $result = $this->serializer->decode(
            (string) $response->getBody(),
            \Netresearch\Sdk\CentralStation\Model\People::class
        );

        return $result->person ?? null;
    }
}
