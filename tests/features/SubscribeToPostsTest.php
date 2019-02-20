<?php

class SubscribeToPostsTest extends FeatureTestCase
{
    function testExample()
    {
      //Having
        $post = $this->createPost();

        $user = factory(\App\User::class)->create();

        $this->actingAs($user);

      //When
        $this->visit($post->url)
          ->press('Subcribirse al post');
      //Then
        $this->seeInDatabase('subscriptions', [
          'user_id' => $user->id,
          'post_id' => $post->id,
        ]);

        $this->seePageIs($post->url)
          ->dontSee('Subcribirse al post');
    }
}
