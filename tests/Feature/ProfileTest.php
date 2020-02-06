<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfileTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_user_has_a_profile()
    {
        /** @var User $user */
        $user = create('App\User');
        $this->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    /** @test */
    public function profiles_display_all_threads_created_by_associated_user()
    {
        /** @var User $user */
        $user = create('App\User');
        /** @var Thread $thread */
        $thread = create('App\Thread',['user_id'=>$user->id]);
        $this->get("/profiles/{$user->name}")
        ->assertSee($thread->title)
        ->assertSee($thread->body);
        }
}
