<?php namespace Modules\Block\Tests\Integration;

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
}
