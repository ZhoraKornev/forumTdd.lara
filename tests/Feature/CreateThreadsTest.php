<?php

namespace Tests\Feature;

use App\Activity;
use App\Reply;
use App\Thread;
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

        factory('App\Channel', 2)->create();
        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => random_int(999999, 9999999)])
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

    /** @test */
    public function authorised_person_can_delete_threads()
    {
        $this->signIn();

        $thread = create('App\Thread',['user_id'=>auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);
        $response = $this->json('DELETE', $thread->path());
        $response->assertStatus(204);
        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
        $this->assertDatabaseMissing('activities', [
            'subject_id' => $thread->id,
            'subject_type' => Thread::class
        ]);
        $this->assertEquals(0,Activity::count());
    }

    /** @test */
    public function unauthorised_users_may_not_delete_threads()
    {
        $this->withExceptionHandling();
        $thread = create('App\Thread');
        $this->delete( $thread->path())->assertRedirect('login');
        $this->signIn();
        $this->delete( $thread->path())->assertStatus(403);
    }

    /** @test */
        public function thread_may_only_be_deleted_by_those_who_have_permission()
        {

        }

}
