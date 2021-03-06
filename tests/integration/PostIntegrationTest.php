<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Post;

class PostIntegrationTest extends TestCase
{
  use DatabaseTransactions;

    function test_a_slug_is_generated_and_save_to_the_database()
    {
      $post = $this->createPost([
        'title' => 'Como instalar Laravel',
      ]);

      $this->assertSame(
        'como-instalar-laravel',
        $post->fresh()->slug
      );
    }
}
