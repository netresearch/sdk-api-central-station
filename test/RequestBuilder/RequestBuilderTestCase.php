<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\RequestBuilder;

use JsonException;
use Netresearch\Sdk\CentralStation\Serializer\JsonSerializer;

/**
 * Class TestCase
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class RequestBuilderTestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var JsonSerializer
     */
    protected $serializer;

    protected function setUp(): void
    {
        $this->serializer = new JsonSerializer();
    }

    /**
     * Asserts that two JSON strings are the same.
     *
     * @param string $expectedJson
     * @param string $actualJson
     *
     * @throws JsonException
     */
    protected static function assertSameJson(string $expectedJson, string $actualJson): void
    {
        // Get rid of the formatting of the test data
        $expectedJson = json_encode(
            json_decode($expectedJson, true, 512, JSON_THROW_ON_ERROR),
            JSON_THROW_ON_ERROR
        );

        self::assertSame($expectedJson, $actualJson);
    }
}
