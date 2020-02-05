<?php

namespace Tests\Unit;

use App\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_channel_consist_of_threads()
    {
        /** @var Channel $channel */
        $channel = create('App\Channel');
        $thread = create('App\Thread', ['channel_id' => $channel->id]);
        $this->assertTrue($channel->threads->contains($thread));
    }
}
