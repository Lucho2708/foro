<?php

namespace App;

use App\User;
use App\Comment;
use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    protected $casts = [
      'pending' => 'boolean'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function comments()
    {
      return $this->hasMany(Comment::class);
    }

    public function setTitleAttribute($value)
    {
      $this->attributes['title'] = $value;

      $this->attributes['slug'] = Str::slug($value);

    }
    public function getUrlAttribute()
    {
      return route('posts.show',[$this->id, $this->slug]);
    }

    public function latestComments()
    {
      return $this->comments()->orderBy('created_at', 'DES');
    }

    public function getSafeHtmlContentAttribute()
    {
        return Markdown::convertToHtml(e($this->content));
    }

    public function subscribers()
    {
      return $this->belongsToMany(User::class, 'subscriptions');
    }
}
