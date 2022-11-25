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
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\People\Common\Person;
use Netresearch\Sdk\CentralStation\Request\People\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\People\CreateValidator;

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
     * Sets the person.
     *
     * @param string      $lastName
     * @param null|string $firstName
     * @param null|string $gender
     * @param null|string $title
     *
     * @return CreateRequestBuilder
     */
    public function setPerson(
        string $lastName,
        string $firstName = null,
        string $gender = null,
        string $title = null
    ): CreateRequestBuilder {
        $this->data['person'] = [
            'lastName'  => $lastName,
            'firstName' => $firstName,
            'gender'    => $gender,
            'title'     => $title,
        ];

        return $this;
    }

    /**
     * @return CreateRequest|RequestInterface
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        CreateValidator::validate($this->data);

        $person = new Person(
            $this->data['person']['lastName']
        );

        if (isset($this->data['person'])) {
            $person->setFirstName($this->data['person']['firstName'])
                ->setGender($this->data['person']['gender'])
                ->setTitle($this->data['person']['title']);
        }

        // Assign values to request
        $request = new CreateRequest($person);

        $this->data = [];

        return $request;
    }
}
