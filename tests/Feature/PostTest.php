<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_posts()
    {
        $posts = factory(Post::class, 10)->create();

        $this->getJson('api/posts')
            ->assertStatus(200)
            ->assertJson([
                'data' => $posts->toArray()
            ]);
    }

    /** @test */
    public function it_creates_a_post()
    {
        $payload = [
            'title' => 'Hello World',
            'body' => 'Body of post for this',
        ];

        $this->postJson('api/posts', $payload)
            ->assertStatus(201)
            ->assertJson($payload);

        $this->assertDatabaseHas('posts', $payload);
    }

}
