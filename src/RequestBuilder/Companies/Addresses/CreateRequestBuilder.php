<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Companies\Addresses;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\Companies\Addresses\Create as CreateRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Addresses\CreateValidator;

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
     * Sets the address.
     *
     * @param string      $street      The street name
     * @param null|string $zip         The zip code
     * @param null|string $city        The city name
     * @param null|string $countryCode The two-letter country code
     * @param null|string $stateCode   The two-letter state code
     *
     * @return CreateRequestBuilder
     */
    public function setAddress(
        string $street,
        string $zip = null,
        string $city = null,
        string $countryCode = null,
        string $stateCode = null
    ): CreateRequestBuilder {
        $this->data['address']['street'] = $street;
        $this->data['address']['zip'] = $zip;
        $this->data['address']['city'] = $city;
        $this->data['address']['countryCode'] = $countryCode;
        $this->data['address']['stateCode'] = $stateCode;
        return $this;
    }

    /**
     * Sets the address's type.
     *
     * @param null|string $type The type of the address (use one of Constants::ADDRESS_TYPE_*)
     *
     * @return CreateRequestBuilder
     */
    public function setType(string $type = null): CreateRequestBuilder
    {
        $this->data['type'] = $type;
        return $this;
    }

    /**
     * Set to TRUE if the address is a primary address.
     *
     * @param bool $primary TRUE/FALSE whether the address is primary or not
     *
     * @return CreateRequestBuilder
     */
    public function setPrimary(bool $primary): CreateRequestBuilder
    {
        $this->data['primary'] = $primary;
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

        $address = new Address();
        $address->setStreet($this->data['address']['street'])
            ->setCity($this->data['address']['city'])
            ->setZip($this->data['address']['zip'])
            ->setCountryCode($this->data['address']['countryCode'])
            ->setStateCode($this->data['address']['stateCode'])
            ->setType($this->data['type']);

        if (isset($this->data['primary'])) {
            $address->setPrimary($this->data['primary']);
        }

        // Assign values to request
        $request = new CreateRequest($address);

        $this->data = [];

        return $request;
    }
}
