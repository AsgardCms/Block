<?php namespace Modules\Block\Tests\Integration;

class BlockRepositoryTest extends BaseBlockTest
{
    /** @test */
    public function it_is_true()
    {
        $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'lorem']]);
        $blocks = $this->block->all();
        dd($blocks);
    }
}
