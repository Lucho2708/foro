<?php
use App\Notifications\PostCommented;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostCommentedTest extends TestCase
{

    use DatabaseTransactions;
    /**
     * @test
     */
    function test_it_builds_a_mail_message()
    {
        $post = factory(\App\Post::class)->create([
          'title' => 'Titulo del post'
        ]);

        $user = factory(\App\User::class)->create([
          'name' => 'Luis Silva'
        ]);

        $comment = factory(\App\Comment::class)->create([
          'post_id' =>$post->id,
          'user_id' =>$user->id
        ]);

        $notification = new PostCommented($comment);

        $subscriber = factory(\App\User::class)->create();

        $message = $notification->toMail($subscriber );

        $this->assertInstanceOf(MailMessage::class, $message);

        $this->assertSame(
          'Nuevo comentario en: Titulo del post',
          $message->subject
        );

        $this->assertSame(
          'Luis Silva escribío un comentario en: Titulo del post',
          $message->introLines[0]
        );

        $this->assertSame(
          $comment->post->url,
          $message->actionUrl
        );


    }
}
