<?php

namespace Modules\Block\Tests\Integration;

use Illuminate\Database\Eloquent\Collection;

class BlockFacadeTest extends BaseBlockTest
{
    /** @test */
    public function it_links_global_facade_to_repository()
    {
        $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'lorem en'], 'fr' => ['body' => 'lorem fr']]);

        $this->assertInstanceOf(Collection::class, \Block::all());
    }

    /** @test */
    public function it_works_as_repository()
    {
        $this->block->create([
            'name' => 'test-block',
            'en' => [
                'body' => 'lorem en',
                'online' => true,
            ],
            'fr' => [
                'body' => 'lorem fr',
                'online' => true,
            ],
        ]);

        $this->assertEquals('lorem en', \Block::get('test-block'));
    }
}
