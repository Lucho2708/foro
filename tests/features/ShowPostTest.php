<?php


class ShowPostTest extends TestCase
{
    function test_a_user_can_see_the_post_details()
    {
      //Having
      $user = $this->defaultUser([
        'name' => 'Luis Silva',
      ]);

      $post = factory(\App\Post::class)->make([
        'title'   => 'Este es el titulo del post',
        'content' => 'Este es el contenido del post'
      ]);

      $user->posts()->save($post);

      //When
      $this->visit(route('post.show',$post))
        ->seeInElement('h1',$post->title)
        ->see($post->content)
        ->see($user->name);
    }
}
