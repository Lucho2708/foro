<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Post $post)
    {
      auth()->user()->subscribedTo($post);

      return redirect($post->url);
    }
}
