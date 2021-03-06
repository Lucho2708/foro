<?php
use App\User;
use App\Post;
use App\Comment;
use App\Notifications\PostCommented;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommentedTest extends TestCase
{

    /**
     * @test
     */
    function test_it_builds_a_mail_message()
    {
        $post = new Post([
          'title' => 'Titulo del post'
        ]);

        $author = new User([
          'name' => 'Luis Silva'
        ]);

        $comment = new Comment;
        $comment->post = $post;
        $comment->user = $author;

        $notification = new PostCommented($comment);

        $subscriber = new User();

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
