<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\People\Protocols;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\Protocols\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\Request\Protocol;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\Protocols\UpdateValidator;

/**
 * The request builder to create a valid "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class UpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the protocol's content.
     *
     * @param string $content The content of the protocol
     *
     * @return UpdateRequestBuilder
     */
    public function setContent(string $content): UpdateRequestBuilder
    {
        $this->data['protocol']['content'] = $content;

        return $this;
    }

    /**
     * Sets the protocol's name.
     *
     * @param string $name The name of the protocol
     *
     * @return UpdateRequestBuilder
     */
    public function setName(string $name): UpdateRequestBuilder
    {
        $this->data['protocol']['name'] = $name;

        return $this;
    }

    /**
     * Set to TRUE if the note should be confidential.
     *
     * @param bool $confidential TRUE/FALSE whether the note is confidential or not
     *
     * @return UpdateRequestBuilder
     */
    public function setConfidential(bool $confidential): UpdateRequestBuilder
    {
        $this->data['protocol']['confidential'] = $confidential;

        return $this;
    }

    /**
     * Sets the protocol's format.
     *
     * @param string $format The format of the protocol (use one of Constants::PROTOCOL_FORMAT_*)
     *
     * @return UpdateRequestBuilder
     */
    public function setFormat(string $format): UpdateRequestBuilder
    {
        $this->data['protocol']['format'] = $format;

        return $this;
    }

    /**
     * Sets the protocol's badge.
     *
     * @param string $badge The badge of the protocol (use one of Constants::PROTOCOL_BADGE_*)
     *
     * @return UpdateRequestBuilder
     */
    public function setBadge(string $badge): UpdateRequestBuilder
    {
        $this->data['protocol']['badge'] = $badge;

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return UpdateRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): UpdateRequest
    {
        // Validate the input
        UpdateValidator::validate($this->data);

        $protocol = new Protocol();

        if (isset($this->data['protocol']['content'])) {
            $protocol->setContent($this->data['protocol']['content']);
        }

        if (isset($this->data['protocol']['name'])) {
            $protocol->setName($this->data['protocol']['name']);
        }

        if (
            isset($this->data['protocol']['confidential'])
            && ($this->data['protocol']['confidential'] === true)
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
        $request = new UpdateRequest();
        $request->setProtocol($protocol);

        $this->data = [];

        return $request;
    }
}
