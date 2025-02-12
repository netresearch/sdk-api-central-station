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
use Netresearch\Sdk\CentralStation\Request\Companies\Index as IndexRequest;
use Netresearch\Sdk\CentralStation\Request\RequestInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\AbstractRequestBuilder;
use Netresearch\Sdk\CentralStation\RequestBuilder\CustomFieldRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\FilterRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\IncludesRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\PaginationRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\SortRequestBuilderInterface;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\CustomFieldTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\FilterTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\IncludesTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\PaginationTrait;
use Netresearch\Sdk\CentralStation\RequestBuilder\Traits\SortTrait;
use Netresearch\Sdk\CentralStation\Validator\Companies\IndexValidator;

/**
 * The request builder to create a valid "index" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 *
 * @api
 */
class IndexRequestBuilder extends AbstractRequestBuilder implements FilterRequestBuilderInterface, IncludesRequestBuilderInterface, PaginationRequestBuilderInterface, SortRequestBuilderInterface, CustomFieldRequestBuilderInterface
{
    use CustomFieldTrait;
    use FilterTrait;
    use IncludesTrait;
    use PaginationTrait;
    use SortTrait;

    /**
     * Sets the restriction to individual tags.
     *
     * @param int|null    $tagId   The tag ID, returns all objects with the same name of the respective tag
     * @param string|null $tagName The tag name, returns all objects that have the corresponding tag
     *
     * @return self
     */
    public function setTagRestriction(
        ?int $tagId = null,
        ?string $tagName = null,
    ): IndexRequestBuilder {
        $this->data['tag'] = [
            'tagId'   => $tagId,
            'tagName' => $tagName,
        ];

        return $this;
    }

    /**
     * This method creates the actual request object and fills it with the data set in the request builder.
     *
     * @return IndexRequest
     *
     * @throws RequestValidatorException
     */
    public function create(): RequestInterface
    {
        // Validate the input
        IndexValidator::validate($this->data);

        // Assign values to request
        $request = new IndexRequest();

        $this->assignPaginationToRequest($request);
        $this->assignSortToRequest($request);
        $this->assignFilterToRequest($request);
        $this->assignIncludesToRequest($request);
        $this->assignCustomFieldToRequest($request);

        if (isset($this->data['tag']['tagId'])) {
            $request->setTagId($this->data['tag']['tagId']);
        }

        if (isset($this->data['tag']['tagName'])) {
            $request->setTagName($this->data['tag']['tagName']);
        }

        $this->data = [];

        return $request;
    }
}
