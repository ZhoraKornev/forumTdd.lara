<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var Thread
     */
    private $thread;

    public function setUp() :void
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $this->get('/threads/'.$this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_replies_that_are_associate_with_a_single_thread()
    {
        /** @var Reply $reply */
        $reply = factory('App\Reply')->create(['thread_id'=>$this->thread->id]);

        $this->get('/threads/' . $this->thread->id)
        ->assertSee($reply->body);
    }
}
