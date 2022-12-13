<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Protocols\Attachments;

use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Attachments\Common\Attachment;
use Netresearch\Sdk\CentralStation\Request\Protocols\Attachments\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Protocols\Attachments\CreateValidator;

/**
 * The request builder to create a valid "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class CreateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the attachment's filename.
     *
     * @param string $filename The filename of the attachment
     *
     * @return CreateRequestBuilder
     */
    public function setFilename(string $filename): CreateRequestBuilder
    {
        $this->data['attachment']['filename'] = $filename;
        return $this;
    }

    /**
     * Sets the attachment content type.
     *
     * @param string $contentType The content type of the attachment (e.g. image/jpeg, ...)
     *
     * @return CreateRequestBuilder
     */
    public function setContentType(string $contentType): CreateRequestBuilder
    {
        $this->data['attachment']['contentType'] = $contentType;
        return $this;
    }

    /**
     * Sets the attachment data.
     *
     * @param string $data The base64 encoded file data
     *
     * @return CreateRequestBuilder
     */
    public function setData(string $data): CreateRequestBuilder
    {
        $this->data['attachment']['data'] = $data;
        return $this;
    }

    /**
     * Sets the attachment's attachable info.
     *
     * @param null|int    $id   The attachable ID
     * @param null|string $type The attachable type
     *
     * @return CreateRequestBuilder
     */
    public function setAttachable(
        int $id = null,
        string $type = null
    ): CreateRequestBuilder {
        $this->data['attachment']['attachableId'] = $id;
        $this->data['attachment']['attachableType'] = $type;
        return $this;
    }

    /**
     * Sets the attachment's category info.
     *
     * @param null|int    $id   The category ID
     * @param null|string $name The category name
     *
     * @return CreateRequestBuilder
     */
    public function setAttachmentCategory(
        int $id = null,
        string $name = null
    ): CreateRequestBuilder {
        $this->data['attachment']['attachmentCategoryId'] = $id;
        $this->data['attachment']['attachmentCategoryName'] = $name;
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
//        CreateValidator::validate($this->data);

        $attachment = new Attachment();
        $attachment->setFilename($this->data['attachment']['filename'])
            ->setContentType($this->data['attachment']['contentType'])
            ->setData($this->data['attachment']['data']);

        if (isset($this->data['attachment']['attachableId'])) {
            $attachment->setAttachableId($this->data['attachment']['attachableId']);
        }

        if (isset($this->data['attachment']['attachableType'])) {
            $attachment->setAttachableType($this->data['attachment']['attachableType']);
        }

        if (isset($this->data['attachment']['attachmentCategoryId'])) {
            $attachment->setAttachmentCategoryId($this->data['attachment']['attachmentCategoryId']);
        }

        if (isset($this->data['attachment']['attachmentCategoryName'])) {
            $attachment->setAttachmentCategoryName($this->data['attachment']['attachmentCategoryName']);
        }

        // Assign values to request
        $request = new CreateRequest($attachment);

        $this->data = [];

        return $request;
    }
}
