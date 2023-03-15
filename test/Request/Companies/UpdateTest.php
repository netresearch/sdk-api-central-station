<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Test\Request\Companies;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Companies\Update;
use Netresearch\Sdk\CentralStation\Request\Company;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "update" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class UpdateTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $company = new Company();
        $company->setName('ABC company')
            ->setBackground('background');

        $request = new Update();
        $request->setCompany($company);

        self::assertSame(
            [
                'company' => [
                    'name'                     => 'ABC company',
                    'background'               => 'background',
                    'positions_attributes'     => null,
                    'tags_attributes'          => null,
                    'tels_attributes'          => null,
                    'emails_attributes'        => null,
                    'homepages_attributes'     => null,
                    'addrs_attributes'         => null,
                    'custom_fields_attributes' => null,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
