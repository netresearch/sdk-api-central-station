<?php

/**
 * This file is part of the package netresearch/sdk-api-central-station.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Netresearch\Sdk\CentralStation\Test\Api\Actions;

use Netresearch\Sdk\CentralStation\Collection\TagsCollection;
use Netresearch\Sdk\CentralStation\Model\Tags;
use Netresearch\Sdk\CentralStation\Model\Tags\Tag;
use Netresearch\Sdk\CentralStation\Request\Tags\Create;
use Netresearch\Sdk\CentralStation\Request\Tags\Index;
use Netresearch\Sdk\CentralStation\Request\Tags\Update;
use Netresearch\Sdk\CentralStation\Test\Provider\Tags\CreateProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\Tags\IndexProvider;
use Netresearch\Sdk\CentralStation\Test\Provider\Tags\ShowProvider;
use Netresearch\Sdk\CentralStation\Test\TestCase;

/**
 * Class TagsTest
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
     * @return \Netresearch\Sdk\CentralStation\Api\Actions\Tags
     */
    private function getTagsApi(
        string $responseJsonFile = '',
        int $tagId = null
    ): \Netresearch\Sdk\CentralStation\Api\Actions\Tags {
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        return $serviceFactoryMock
            ->api()
            ->tags($tagId);
    }

    /**
     * @return string[][]
     */
    public function indexResponseDataProvider(): array
    {
        return [
            'Response' => [
                IndexProvider::indexResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "index" method.
     *
     * @dataProvider indexResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function index(string $responseJsonFile): void
    {
        $tagsApi = $this->getTagsApi($responseJsonFile);
        $result  = $tagsApi->index(new Index());

        self::assertWebserviceUrl('https://www.example.org/tags', $tagsApi);
        self::assertHttpMethod('GET', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertInstanceOf(TagsCollection::class, $result);
        self::assertContainsOnlyInstancesOf(Tags::class, $result);

        foreach ($result as $tags) {
            self::assertInstanceOf(Tags::class, $tags);
            self::assertInstanceOf(Tags\Tag::class, $tags->tag);
        }

        $this->assertFirstTag($result[0]->tag);
        $this->assertSecondTag($result[1]->tag);
    }

    private function assertFirstTag(Tag $tag)
    {
        self::assertSame(45067258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8439487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mobilität / Verkehr', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:32', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    private function assertSecondTag(Tag $tag)
    {
        self::assertSame(45067261, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8439487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mess- / Verfahrenstechnik / Sensorik', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:22', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * @return string[][]
     */
    public function showResponseDataProvider(): array
    {
        return [
            'Response' => [
                ShowProvider::showResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "show" method.
     *
     * @dataProvider showResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function show(string $responseJsonFile): void
    {
        $tagsApi = $this->getTagsApi($responseJsonFile, 123456);
        $result  = $tagsApi->show();

        self::assertWebserviceUrl('https://www.example.org/tags/123456', $tagsApi);
        self::assertHttpMethod('GET', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertInstanceOf(Tags\Tag::class, $result);

        $this->assertFirstTag($result);
    }

    /**
     * @return string[][]
     */
    public function createResponseDataProvider(): array
    {
        return [
            'Response' => [
                CreateProvider::createResponseSuccess(),
            ],
        ];
    }

    /**
     * Tests "create" method.
     *
     * @dataProvider createResponseDataProvider
     * @test
     *
     * @param string $responseJsonFile
     */
    public function create(string $responseJsonFile): void
    {
        $tagsApi = $this->getTagsApi($responseJsonFile);

        $result = $tagsApi
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Tags\Common\Tag()
                )
            );

        self::assertWebserviceUrl('https://www.example.org/tags', $tagsApi);
        self::assertHttpMethod('POST', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertInstanceOf(Tags\Tag::class, $result);

        $this->assertCreatedTag($result);
    }

    private function assertCreatedTag(Tag $tag)
    {
        self::assertSame(45067258, $tag->id);
        self::assertSame(47143, $tag->accountId);
        self::assertSame(8439487, $tag->attachableId);
        self::assertSame('Company', $tag->attachableType);
        self::assertSame('Branche|Mobilität / Verkehr', $tag->name);
        self::assertSame('13.10.2019', $tag->createdAt->format('d.m.Y'));
        self::assertSame('05.11.2020 10:44:32', $tag->updatedAt->format('d.m.Y H:i:s'));
    }

    /**
     * Tests "update" method.
     *
     * @test
     */
    public function update(): void
    {
        $tagsApi = $this->getTagsApi('', 123456);
        $result  = $tagsApi->update(new Update());

        self::assertWebserviceUrl('https://www.example.org/tags/123456', $tagsApi);
        self::assertHttpMethod('PUT', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertTrue($result);
    }

    /**
     * Tests "delete" method.
     *
     * @test
     */
    public function delete(): void
    {
        $tagsApi = $this->getTagsApi('', 123456);
        $result  = $tagsApi->delete();

        self::assertWebserviceUrl('https://www.example.org/tags/123456', $tagsApi);
        self::assertHttpMethod('DELETE', $tagsApi);
        self::assertHttpHeaders($tagsApi);
        self::assertTrue($result);
    }
}
