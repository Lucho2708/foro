<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['comment', 'post_id'];

  public function post()
  {
    return $hist->belongsTo(Post::class);
  }
}
