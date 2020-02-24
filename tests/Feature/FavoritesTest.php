<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_anything()
    {
        $this->withExceptionHandling()
            ->post('replies/1/favorite')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post('replies/' . $reply->id . '/favorite');
        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_cannot_add_favorites_twice()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $this->post('replies/' . $reply->id . '/favorite');
        $this->post('replies/' . $reply->id . '/favorite');
        $this->assertCount(1, $reply->favorites);
    }


    /** @test */
    public function an_authenticated_user_can_unfavorite_any_reply()
    {
        $this->signIn();
        $reply = create('App\Reply');
        $reply->favorite();
        $this->delete('replies/' . $reply->id . '/favorite');
        $this->assertCount(0, $reply->favorites);
    }
}

