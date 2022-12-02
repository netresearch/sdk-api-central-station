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
     * Sets the tag's name.
     *
     * @param string $name The name of the tag
     *
     * @return UpdateRequestBuilder
     */
    public function setTagName(string $name): UpdateRequestBuilder
    {
        $this->data['tag']['name'] = $name;
        return $this;
    }

    /**
     * Sets the tag's attached data.
     *
     * @param int    $attachableId   The ID of the attached object, e.g. ID of person, company, offer or project
     * @param string $attachableType The type of the attached object (use one of Constants::TAG_TYPE_*)
     *
     * @return UpdateRequestBuilder
     */
    public function setAttachedData(
        int $attachableId,
        string $attachableType
    ): UpdateRequestBuilder {
        $this->data['tag']['attachableId'] = $attachableId;
        $this->data['tag']['attachableType'] = $attachableType;

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
        $request = new UpdateRequest();

        if (isset($this->data['tag'])) {
            $tag = new Tag();
            $tag->setName($this->data['tag']['name'])
                ->setAttachableId($this->data['tag']['attachableId'])
                ->setAttachableType($this->data['tag']['attachableType']);

            $request->setTag($tag);
        }

        $this->data = [];

        return $request;
    }
}
