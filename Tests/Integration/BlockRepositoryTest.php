<?php namespace Modules\Block\Tests\Integration;

use Faker\Factory;

class BlockRepositoryTest extends BaseBlockTest
{
    /** @test */
    public function it_creates_blocks()
    {
        $block = $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'lorem en'], 'fr' => ['body' => 'lorem fr']]);
        $blocks = $this->block->all();

        $this->assertCount(1, $blocks);
        $this->assertEquals('testBlock', $block->name);
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
