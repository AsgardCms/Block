<?php

namespace Modules\Block\Tests\Integration;

use Faker\Factory;
use Illuminate\Support\Facades\App;
use Modules\Block\Facades\BlockFacade as Block;

class BlockRepositoryTest extends BaseBlockTest
{
    /** @test */
    public function it_creates_blocks()
    {
        $block = $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'lorem en'], 'fr' => ['body' => 'lorem fr']]);
        $blocks = $this->block->all();

        $this->assertCount(1, $blocks);
        $this->assertEquals('testblock', $block->name);
        $this->assertEquals('lorem en', $block->translate('en')->body);
        $this->assertEquals('lorem fr', $block->translate('fr')->body);
    }

    /** @test */
    public function it_gets_only_online_blocks()
    {
        $this->createRandomBlock();
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, false);

        $allBlocks = $this->block->all();
        $onlineBlocksFr = $this->block->allOnlineInLang('fr');
        $onlineBlocksEn = $this->block->allOnlineInLang('en');

        $this->assertCount(4, $allBlocks);
        $this->assertCount(2, $onlineBlocksFr);
        $this->assertCount(3, $onlineBlocksEn);
    }

    /** @test */
    public function it_gets_block_by_name()
    {
        $this->block->create(['name' => 'testblock', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => true]]);
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, true);

        $block = $this->block->get('testblock');

        $this->assertEquals('lorem en', $block);
    }

    /** @test */
    public function it_gets_block_by_name_if_online()
    {
        $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => false]]);
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, true);

        App::setLocale('fr');
        $block = $this->block->get('testBlock');
        $this->assertEquals('', $block);

        App::setLocale('en');
        $block = $this->block->get('testblock');
        $this->assertEquals('lorem en', $block);
    }

    /** @test */
    public function it_gets_block_by_facade()
    {
        $this->block->create(['name' => 'testblock', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => false]]);
        $this->createRandomBlock(true, true);
        $this->createRandomBlock(true, true);

        $block = Block::get('testblock');

        $this->assertEquals('lorem en', $block);
    }

    /** @test */
    public function it_slugifies_the_name_property()
    {
        $block = $this->block->create(['name' => 'test block', 'en' => ['body' => 'lorem en', 'online' => true], 'fr' => ['body' => 'lorem fr', 'online' => false]]);

        $this->assertEquals('test-block', $block->name);
    }

    public function it_makes_name_unique()
    {
        $this->block->create(['name' => 'test block']);
        $block = $this->block->create(['name' => 'test block']);

        $this->assertEquals('test-block-1', $block->name);
    }

    /** @test */
    public function it_increments_name_if_not_unique()
    {
        $this->block->create(['name' => 'test block']);
        $this->block->create(['name' => 'test block']);
        $block1 = $this->block->create(['name' => 'test block']);
        $block2 = $this->block->create(['name' => 'test block']);

        $this->assertEquals('test-block-2', $block1->name);
        $this->assertEquals('test-block-3', $block2->name);
    }

    /** @test */
    public function it_updates_block_without_name_change()
    {
        $block = $this->block->create(['name' => 'test block']);
        $this->block->update($block, ['name' => 'test-block']);

        $this->assertEquals($block->name, 'test-block');
    }

    /** @test */
    public function it_updates_block_with_name_change()
    {
        $block = $this->block->create(['name' => 'test block']);
        $this->block->update($block, ['name' => 'my awesome block']);

        $this->assertEquals($block->name, 'my-awesome-block');
    }

    /** @test */
    public function it_returns_empty_string_if_block_doesnt_exist()
    {
        $block = $this->block->get('heya');

        $this->assertSame('', $block);
    }

    /**
     * Create a block with random properties
     * @param bool $statusEn
     * @param bool $statusFr
     * @return mixed
     */
    private function createRandomBlock($statusEn = false, $statusFr = false)
    {
        $factory = Factory::create();

        $data = [
            'name' => $factory->word,
            'en' => [
                'body' => $factory->text,
                'online' => $statusEn,
            ],
            'fr' => [
                'body' => $factory->text,
                'online' => $statusFr,
            ],
        ];

        return $this->block->create($data);
    }
}
