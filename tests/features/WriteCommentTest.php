<?php


class WriteCommentTest extends FeatureTestCase
{
    function test_u_user_can_write_a_comment()
    {
        $post = $this->createPost();

        $user = $this->defaultUser();

        $this->actingAs($user)
          ->visit($post->url)
          ->type('Un comentario', 'comment')
          ->press('Publicar comentario');

        $this->seeInDatabase('comments', [
          'comment' => 'Un comentario',
          'user_id' => $user->id,
          'post_id' => $post->id
        ]);

        $this->seePageIs($post->url);
    }

    function test_creating_a_comment_requires_authentication()
    {
      $post = $this->createPost();

      $user = $this->defaultUser();

      $this->actingAs($user)
        ->visit($post->url)
        ->press('Publicar comentario')
        ->seePageIs($post->url)
        ->seeErrors([
          'comment' => 'El campo comentario es obligatorio'
        ]);
    }
}