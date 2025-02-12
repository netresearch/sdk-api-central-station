<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions;

use Netresearch\Sdk\CentralStation\Api\Actions\Tags;
use Netresearch\Sdk\CentralStation\Exception\AuthenticationException;
use Netresearch\Sdk\CentralStation\Exception\DetailedServiceException;
use Netresearch\Sdk\CentralStation\Exception\ServiceException;
use Netresearch\Sdk\CentralStation\Model\Container\Collection\TagContainerCollection;
use Netresearch\Sdk\CentralStation\Model\Container\TagContainer;
use Netresearch\Sdk\CentralStation\Model\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Index;
use Netresearch\Sdk\CentralStation\Test\Provider\TagsProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class TagsTest.
 *
 * Tests the mapping of the JSON response to the proper models.
 *
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license Netresearch https://www.netresearch.de
 * @link    https://www.netresearch.de
 */
class TagsTest extends TestCase
{
    /**
     * Returns an instance of the tags API endpoint.
     *
     * @param string   $responseJsonFile
     * @param int|null $tagId
     *
     * @return Tags
     *
     * @throws ServiceException
     */
    private function getTagsApi(
        string $responseJsonFile = '',
        ?int $tagId = null,
    ): Tags {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->tags($tagId);
    }

    /**
     * @return string[][]
     */
    public static function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                TagsProvider::indexResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "index" method.
     *
     * @dataProvider indexResponseDataProvider
     *
     * @test
     *
     * @param string $responseJsonFile
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function index(string $responseJsonFile): void
    {
        $tagsApi = $this->getTagsApi($responseJsonFile);
        $result  = $tagsApi->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/tags', $tagsApi);
        self::assertHttpMethod('GET', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertInstanceOf(TagContainerCollection::class, $result);
        self::assertContainsOnlyInstancesOf(TagContainer::class, $result);

        foreach ($result as $tags) {
            self::assertInstanceOf(TagContainer::class, $tags);
            self::assertInstanceOf(Tag::class, $tags->tag);
        }

        $this->assertFirstTag($result->offsetGet(0)->tag);
        $this->assertSecondTag($result->offsetGet(1)->tag);
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertFirstTag(Tag $tag): void
    {
        self::assertSame(45_067_258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8_439_487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mobilität / Verkehr', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:32', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Asserts that the data of the given tag matches the expected values.
     *
     * @param Tag $tag
     *
     * @return void
     */
    private function assertSecondTag(Tag $tag): void
    {
        self::assertSame(45_067_261, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8_439_487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mess- / Verfahrenstechnik / Sensorik', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:22', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public static function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                TagsProvider::showResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "show" method.
     *
     * @dataProvider showResponseDataProvider
     *
     * @test
     *
     * @param string $responseJsonFile
     *
     * @throws AuthenticationException
     * @throws DetailedServiceException
     * @throws ServiceException
     */
    public function show(string $responseJsonFile): void
    {
        $tagsApi = $this->getTagsApi($responseJsonFile, 123456);
        $result  = $tagsApi->show();

        self::assertWebserviceUrl('https://www.example.org/tags/123456', $tagsApi);
        self::assertHttpMethod('GET', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertInstanceOf(Tag::class, $result);

        $this->assertFirstTag($result);
    }
}
