<?php


class ShowPostTest extends FeatureTestCase
{
    function test_a_user_can_see_the_post_details()
    {
      //Having
      $user = $this->defaultUser([
        'name' => 'Luis Silva',
      ]);

      $post = $this->createPost([
        'title'   => 'Este es el titulo del post',
        'content' => 'Este es el contenido del post',
        'user_id' => $user->id
      ]);

      //When
      $this->visit($post->url)
        ->seeInElement('h1',$post->title)
        ->see($post->content)
        ->see('Luis Silva');
    }

    function  test_old_urls_are_redirected()
    {
      $post = $this->createPost([
        'title'   => 'Old title',
      ]);

      $url = $post->url;

      $post->update(['title'=>"New title"]);

      $this->visit($url)
        ->seePageIs($post->url);

    }

/*
    function test_post_url_with_worng_slugs_still_work()
    {
      $user = $this->defaultUser();

      $post = factory(\App\Post::class)->make([
        'title'   => 'Old title',
      ]);

      $user->posts()->save($post);

      $url = $post->url;

      $post->update(['title'=>"New title"]);

      $this->visit($url)
        ->assertResponseOk()
        ->see('New title');
    }

*/
}
