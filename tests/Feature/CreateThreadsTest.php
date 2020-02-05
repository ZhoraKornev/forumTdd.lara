<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * @test
     */
    public function guest_may_not_create_threads()
    {
        $this->withExceptionHandling();

        $thread = make('App\Thread');
        $this->post('/threads', $thread->toArray());

        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        $thread = make('App\Thread');
        $response = $this->post('/threads', $thread->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**
     * @test
     */
    public function a_thread_belongs_to_a_channel()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    /**
     * @test
     */
    public function a_thread_requires_a_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */
    public function a_thread_requires_a_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */
    public function a_thread_requires_a_valid_channel()
    {

        factory('App\Channel',2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => random_int(999999,9999999)])
            ->assertSessionHasErrors('channel_id');
    }


    /**
     * @param array $override
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function publishThread($override = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $override);
        return $this->post('/threads', $thread->toArray());

    }


}
