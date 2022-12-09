<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People\Protocols;

use Netresearch\Sdk\CentralStation\Api\RequestInterface;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\Protocols\Common\Protocol;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\Protocols\CreateValidator;

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
     * Sets the protocol's content.
     *
     * @param string $content The content of the protocol
     *
     * @return CreateRequestBuilder
     */
    public function setContent(string $content): CreateRequestBuilder
    {
        $this->data['protocol']['content'] = $content;
        return $this;
    }

    /**
     * Sets the protocol's name.
     *
     * @param string $name The name of the protocol
     *
     * @return CreateRequestBuilder
     */
    public function setName(string $name): CreateRequestBuilder
    {
        $this->data['protocol']['name'] = $name;
        return $this;
    }

    /**
     * Set to TRUE if the note should be confidential.
     *
     * @param bool $confidential TRUE/FALSE whether the note is confidential or not
     *
     * @return CreateRequestBuilder
     */
    public function setConfidential(bool $confidential): CreateRequestBuilder
    {
        $this->data['protocol']['confidential'] = $confidential;
        return $this;
    }

    /**
     * Sets the protocol's format.
     *
     * @param string $format The format of the protocol (use one of Constants::PROTOCOL_FORMAT_*)
     *
     * @return CreateRequestBuilder
     */
    public function setFormat(string $format): CreateRequestBuilder
    {
        $this->data['protocol']['format'] = $format;
        return $this;
    }

    /**
     * Sets the protocol's badge.
     *
     * @param string $badge The badge of the protocol (use one of Constants::PROTOCOL_BADGE_*)
     *
     * @return CreateRequestBuilder
     */
    public function setBadge(string $badge): CreateRequestBuilder
    {
        $this->data['protocol']['badge'] = $badge;
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

        $protocol = new Protocol();
        $protocol->setContent($this->data['protocol']['content']);

        if (isset($this->data['protocol']['name'])) {
            $protocol->setName($this->data['protocol']['name']);
        }

        if (isset($this->data['protocol']['confidential'])
            && $this->data['protocol']['confidential']
        ) {
            $protocol->setConfidential($this->data['protocol']['confidential']);
        }

        if (isset($this->data['protocol']['format'])) {
            $protocol->setFormat($this->data['protocol']['format']);
        }

        if (isset($this->data['protocol']['badge'])) {
            $protocol->setBadge($this->data['protocol']['badge']);
        }

        // Assign values to request
        $request = new CreateRequest($protocol);

        $this->data = [];

        return $request;
    }
}
