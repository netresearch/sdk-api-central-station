<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Request\People\Addresses;

use Netresearch\Sdk\CentralStation\Constants;
use Netresearch\Sdk\CentralStation\Request\Address;
use Netresearch\Sdk\CentralStation\Request\People\Addresses\Create;
use PHPUnit\Framework\TestCase;

/**
 * Unit test class for the "create" request.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class CreateTest extends TestCase
{
    /**
     * Tests creating a valid serialized request structure.
     *
     * @test
     */
    public function jsonSerialize(): void
    {
        $address = new Address();
        $address
            ->setStreet('Mustergasse 1')
            ->setZip('01234')
            ->setCity('Musterstadt')
            ->setStateCode('SN')
            ->setCountryCode('DE')
            ->setPrimary(true)
            ->setType(Constants::ADDRESS_TYPE_PRIVATE);

        $request = new Create($address);

        self::assertSame(
            [
                'addr' => [
                    'id'           => null,
                    'street'       => 'Mustergasse 1',
                    'zip'          => '01234',
                    'city'         => 'Musterstadt',
                    'state_code'   => 'SN',
                    'country_code' => 'DE',
                    'atype'        => 'private',
                    'primary'      => true,
                ],
            ],
            $request->jsonSerialize()
        );
    }
}
