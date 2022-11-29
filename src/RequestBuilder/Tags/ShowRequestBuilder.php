<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Tags;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Tags\Show as ShowRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Tags\ShowValidator;

/**
 * The request builder to create a valid "show" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class ShowRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the tag ID.
     *
     * @param int $tagId A valid tag ID
     *
     * @return ShowRequestBuilder
     */
    public function setTagId(
        int $tagId
    ): ShowRequestBuilder {
        $this->data['tagId'] = $tagId;

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return ShowRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        ShowValidator::validate($this->data);

        // Assign values to request
        $request = new ShowRequest($this->data['tagId']);

        $this->data = [];

        return $request;
    }
}
