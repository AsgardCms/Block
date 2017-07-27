<?php

namespace Modules\Block\Tests\Integration;

use Illuminate\Support\Facades\Event;
use Modules\Block\Events\BlockContentIsRendering;

class BlockContentIsRenderingTest extends BaseBlockTest
{
    /** @test */
    public function it_can_change_final_content()
    {
        Event::listen(BlockContentIsRendering::class, function (BlockContentIsRendering $event) {
            $event->setBody('<strong>' . $event->getOriginal() . '</strong>');
        });

        $block = $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'My Block Body'], 'fr' => ['body' => 'lorem fr']]);

        $this->assertEquals('<strong>My Block Body</strong>', $block->body);
    }

    /** @test */
    public function it_doesnt_alter_content_if_no_listeners()
    {
        $block = $this->block->create(['name' => 'testBlock', 'en' => ['body' => 'My Block Body'], 'fr' => ['body' => 'lorem fr']]);

        $this->assertEquals('My Block Body', $block->body);
    }
}
