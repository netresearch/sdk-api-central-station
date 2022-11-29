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
use Netresearch\Sdk\CentralStation\Request\Tags\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Tags\CreateValidator;

/**
 * The request builder to create a valid "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the tag's data.
     *
     * @param string $name           The name of the tag
     * @param int    $attachableId   The attachable ID
     * @param string $attachableType The attachable type
     *
     * @return CreateRequestBuilder
     */
    public function setTag(
        string $name,
        int $attachableId,
        string $attachableType
    ): CreateRequestBuilder {
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
     * @return CreateRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        CreateValidator::validate($this->data);

        $tag = new Tag($this->data['tag']['name']);
        $tag->setAttachableId($this->data['tag']['attachableId'])
            ->setAttachableType($this->data['tag']['attachableType']);

        // Assign values to request
        $request = new CreateRequest($tag);

        $this->data = [];

        return $request;
    }
}
