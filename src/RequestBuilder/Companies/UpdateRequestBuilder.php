<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\RequestBuilder\Companies;

use Netresearch\Sdk\CentralStation\Exception\RequestValidatorException;
use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\Addresses;
use Netresearch\Sdk\CentralStation\Request\ContactDetail;
use Netresearch\Sdk\CentralStation\Request\ContactDetails;
use Netresearch\Sdk\CentralStation\Request\Companies\Update as UpdateRequest;
use Netresearch\Sdk\CentralStation\Request\Company;
use Netresearch\Sdk\CentralStation\Request\Position;
use Netresearch\Sdk\CentralStation\Request\Positions;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\Request\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\Validator\Companies\UpdateValidator;

/**
 * The request builder to create a valid "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 * @api
 */
class UpdateRequestBuilder extends AbstractRequestBuilder
{
    /**
     * Sets the company's data.
     *
     * @param string $name The name of the company
     *
     * @return UpdateRequestBuilder
     */
    public function setCompany(string $name): UpdateRequestBuilder
    {
        $this->data['company']['name'] = $name;

        return $this;
    }

    /**
     * Sets the background information about the company.
     *
     * @param string $background The background information about the company
     *
     * @return UpdateRequestBuilder
     */
    public function setBackground(string $background): UpdateRequestBuilder
    {
        $this->data['company']['background'] = $background;
        return $this;
    }

    /**
     * Adds a position attribute.
     *
     * @param string $companyName The name of the company
     * @param string $position    The name of the position at the company
     * @param bool   $primary     TRUE if the position is the primary one
     *
     * @return UpdateRequestBuilder
     */
    public function addPosition(
        string $companyName,
        string $position,
        bool $primary = false
    ): UpdateRequestBuilder {
        if (!isset($this->data['positions'])) {
            $this->data['positions'] = [];
        }

        $this->data['positions'][] = [
            'companyName' => $companyName,
            'position'    => $position,
            'primary'     => $primary,
        ];

        return $this;
    }

    /**
     * Adds a tag attribute.
     *
     * @param string $tagName The name of the tag
     *
     * @return UpdateRequestBuilder
     */
    public function addTag(string $tagName): UpdateRequestBuilder
    {
        if (!isset($this->data['tags'])) {
            $this->data['tags'] = [];
        }

        if (!in_array($tagName, $this->data['tags'], true)) {
            $this->data['tags'][] = $tagName;
        }

        return $this;
    }

    /**
     * Adds a telephone number attribute.
     *
     * @param null|int    $id          The ID of the record to update
     * @param null|string $type        The type of the telephone number (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param null|string $phoneNumber The telephone number
     *
     * @return UpdateRequestBuilder
     */
    public function addTelephone(
        int $id = null,
        string $type = null,
        string $phoneNumber = null
    ): UpdateRequestBuilder {
        if (!isset($this->data['phoneNumbers'])) {
            $this->data['phoneNumbers'] = [];
        }

        $this->data['phoneNumbers'][] = [
            'id'          => $id,
            'type'        => $type,
            'phoneNumber' => $phoneNumber,
        ];

        return $this;
    }

    /**
     * Adds an email address attribute.
     *
     * @param null|int    $id           The ID of the record to update
     * @param null|string $type         The type of the email address (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param null|string $emailAddress The email address
     *
     * @return UpdateRequestBuilder
     */
    public function addEmailAddress(
        int $id = null,
        string $type = null,
        string $emailAddress = null
    ): UpdateRequestBuilder {
        if (!isset($this->data['emailAddresses'])) {
            $this->data['emailAddresses'] = [];
        }

        $this->data['emailAddresses'][] = [
            'id'           => $id,
            'type'         => $type,
            'emailAddress' => $emailAddress,
        ];

        return $this;
    }

    /**
     * Adds a website attribute.
     *
     * @param null|int    $id      The ID of the record to update
     * @param null|string $type    The type of the website (use one of Constants::CONTACT_DETAILS_TYPE)
     * @param null|string $website The website address
     *
     * @return UpdateRequestBuilder
     */
    public function addWebsite(
        int $id = null,
        string $type = null,
        string $website = null
    ): UpdateRequestBuilder {
        if (!isset($this->data['websites'])) {
            $this->data['websites'] = [];
        }

        $this->data['websites'][] = [
            'id'      => $id,
            'type'    => $type,
            'website' => $website,
        ];

        return $this;
    }

    /**
     * Adds an address attribute.
     *
     * @param null|int    $id          The ID of the address to update
     * @param null|string $type        The type of address (use one of Constants::ADDRESS_TYPE_*)
     * @param null|string $street      The street name
     * @param null|string $zip         The zip code
     * @param null|string $city        The city name
     * @param null|string $countryCode The two-letter country code
     * @param null|string $stateCode   The two-letter state code
     * @param bool        $primary     TRUE if the address is the primary one
     *
     * @return UpdateRequestBuilder
     */
    public function addAddress(
        int $id = null,
        string $type = null,
        string $street = null,
        string $zip = null,
        string $city = null,
        string $countryCode = null,
        string $stateCode = null,
        bool $primary = false
    ): UpdateRequestBuilder {
        if (!isset($this->data['addresses'])) {
            $this->data['addresses'] = [];
        }

        $this->data['addresses'][] = [
            'id'          => $id,
            'type'        => $type,
            'street'      => $street,
            'zip'         => $zip,
            'city'        => $city,
            'countryCode' => $countryCode,
            'stateCode'   => $stateCode,
            'primary'     => $primary,
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
        $request = new UpdateRequest();

        if (isset($this->data['company'])) {
            $company = new Company();
            $company->setName($this->data['company']['name']);

            if (isset($this->data['company']['background'])) {
                $company->setBackground($this->data['company']['background']);
            }

            // Add positions
            if (isset($this->data['positions'])) {
                $positions = [];

                foreach ($this->data['positions'] as $item) {
                    $position = new Position();
                    $position->setCompanyName($item['companyName'])
                        ->setName($item['position'])
                        ->setPrimaryFunction($item['primary']);

                    $positions[] = $position;
                }

                $company->setPositions(new Positions($positions));
            }

            // Add tags
            if (isset($this->data['tags'])) {
                $tags = [];

                foreach ($this->data['tags'] as $tagName) {
                    $tag = new Tag();
                    $tag->setName($tagName);

                    $tags[] = $tag;
                }

                $company->setTags(new Tags($tags));
            }

            // Add phone numbers
            if (isset($this->data['phoneNumbers'])) {
                $phoneNumbers = [];

                foreach ($this->data['phoneNumbers'] as $item) {
                    $phoneNumber = new ContactDetail();
                    $phoneNumber->setId($item['id'])
                        ->setType($item['type'])
                        ->setName($item['phoneNumber']);

                    $phoneNumbers[] = $phoneNumber;
                }

                $company->setPhoneNumbers(new ContactDetails($phoneNumbers));
            }

            // Add email addresses
            if (isset($this->data['emailAddresses'])) {
                $emailAddresses = [];

                foreach ($this->data['emailAddresses'] as $item) {
                    $emailAddress = new ContactDetail();
                    $emailAddress->setId($item['id'])
                        ->setType($item['type'])
                        ->setName($item['emailAddress']);

                    $emailAddresses[] = $emailAddress;
                }

                $company->setEmailAddresses(new ContactDetails($emailAddresses));
            }

            // Add websites
            if (isset($this->data['websites'])) {
                $homepages = [];

                foreach ($this->data['websites'] as $item) {
                    $homepage = new ContactDetail();
                    $homepage->setId($item['id'])
                        ->setType($item['type'])
                        ->setName($item['website']);

                    $homepages[] = $homepage;
                }

                $company->setHomepages(new ContactDetails($homepages));
            }

            // Add addresses
            if (isset($this->data['addresses'])) {
                $addresses = [];

                foreach ($this->data['addresses'] as $item) {
                    $address = new Address();
                    $address->setId($item['id'])
                        ->setType($item['type'])
                        ->setStreet($item['street'])
                        ->setCity($item['city'])
                        ->setCountryCode($item['countryCode'])
                        ->setStateCode($item['stateCode'])
                        ->setZip($item['zip'])
                        ->setPrimary($item['primary']);

                    $addresses[] = $address;
                }

                $company->setAddresses(new Addresses($addresses));
            }

            $request->setCompany($company);
        }

        $this->data = [];

        return $request;
    }
}
