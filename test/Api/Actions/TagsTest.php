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
use Netresearch\Sdk\CentralStation\Request\Tags\Show;
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
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->tags()
            ->index(new Index());

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
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->tags()
            ->show(new Show(123456));

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
        $serviceFactoryMock = $this->getServiceFactoryMock($responseJsonFile);

        $result = $serviceFactoryMock
            ->api()
            ->tags()
            ->create(
                new Create(
                    new \Netresearch\Sdk\CentralStation\Request\Tags\Common\Tag('')
                )
            );

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
        $serviceFactoryMock = $this->getServiceFactoryMock();

        $result = $serviceFactoryMock
            ->api()
            ->tags()
            ->update(
                new Update(123456)
            );

        self::assertTrue($result);
    }

    /**
     * Tests "delete" method.
     *
     * @test
     */
    public function delete(): void
    {
        $serviceFactoryMock = $this->getServiceFactoryMock();

        $result = $serviceFactoryMock
            ->api()
            ->tags()
            ->delete(12345);

        self::assertTrue($result);
    }
}
