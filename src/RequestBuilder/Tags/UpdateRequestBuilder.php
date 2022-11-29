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
use Netresearch\Sdk\CentralStation\Request\Tags\Common\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Tags\UpdateValidator;

/**
 * The request builder to create a valid "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the tag ID.
     *
     * @param int $tagId A valid tag ID
     *
     * @return UpdateRequestBuilder
     */
    public function setTagId(
        int $tagId
    ): UpdateRequestBuilder {
        $this->data['tagId'] = $tagId;

        return $this;
    }

    /**
     * Sets the tag's data.
     *
     * @param string      $name           The name of the tag
     * @param null|int    $attachableId   The attachable ID
     * @param null|string $attachableType The attachable type
     *
     * @return UpdateRequestBuilder
     */
    public function setTag(
        string $name,
        int $attachableId = null,
        string $attachableType = null
    ): UpdateRequestBuilder {
        $this->data['tag'] = [
            'name'           => $name,
            'attachableId'   => $attachableId,
            'attachableType' => $attachableType,
        ];

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return UpdateRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        UpdateValidator::validate($this->data);

        // Assign values to request
        $request = new UpdateRequest($this->data['tagId']);

        $tag = new Tag($this->data['tag']['name']);
        $tag->setAttachableId($this->data['tag']['attachableId'])
            ->setAttachableType($this->data['tag']['attachableType']);

        $request->setTag($tag);

        $this->data = [];

        return $request;
    }
}
