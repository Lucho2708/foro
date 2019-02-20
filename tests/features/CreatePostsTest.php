<?php

use App\Post;

class CreatePostsTest extends FeatureTestCase
{
  public function test_a_user_create_a_post()
  {
    //Teniendo esta informacion y un usuario conectado [When]
    $title = 'Esta es una pregunta';
    $content = 'Este es el contenido';

    $this->actingAs( $user = $this->defaultUser());
    //Cuando sucede [Then]
    $this->visit(route('posts.create'))
      ->type($title , 'title')
      ->type($content, 'content')
      ->press('Publicar');
      //Entonces[Then]
    $this->seeInDatabase('posts',[
      'title'=>$title,
      'content'=>$content,
      'pending'=>true,
      'user_id'=>$user->id,
      'slug' =>'esta-es-una-pregunta'
    ]);

    $post = Post::first();

    $this->seeInDatabase('subscriptions', [
      'user_id' => $user->id,
      'post_id' => $post->id,
    ]);
    //El usuari es redireccionado a los posts despues de crear.[]
    $this->seePageIs($post->url);


  }
  public function test_creating_a_post_requires_authentication()
  {
    //When
    $this->visit(route('posts.create'))
      ->seePageIs(route('login'));

  }

  function test_create_post_form_validation()
  {
    $this->actingAs($this->defaultUser())
      ->visit(route('posts.create'))
      ->press('Publicar')
      ->seePageIs(route('posts.create'))
      ->seeErrors([
        'title' => 'El campo título es obligatorio',
        'content'=>'El campo contenido es obligatorio'
      ]);
  }
}
