<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Request\People\Merge as MergeRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\MergeValidator;

/**
 * The request builder to create a valid "merge" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class MergeRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Adds the ID of the person to merge to.
     *
     * @param int $personId The ID of the person to merge to
     *
     * @return MergeRequestBuilder
     */
    public function setPersonId(
        int $personId
    ): MergeRequestBuilder {
        $this->data['personId'] = $personId;

        return $this;
    }

    /**
     * Adds the ID of a person to be merged.
     *
     * @param int $id The ID of the person to be merged
     *
     * @return MergeRequestBuilder
     */
    public function addPersonToMerge(
        int $id
    ): MergeRequestBuilder {
        $this->data['merged'][] = $id;

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return MergeRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        MergeValidator::validate($this->data);

        $request = new MergeRequest($this->data['personId']);
        $request->setMergeIds(...$this->data['merged']);

        $this->data = [];

        return $request;
    }
}
