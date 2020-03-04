<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
  public function store(Request $request)
  {
    $params = $request->validate([
      'post_id' => 'required|exists:posts,id',
      'name' => 'max:200',
      'content' => 'required|max:2000',
    ]);

    $post = Post::findOrFail($params['post_id']);
    $post->comments()->create($params);

    return redirect()->route('posts.show', ['post' => $post]);
  }

  public function destroy($id)
  {
    $comment = Comment::findOrFail($id);
    $comment->delete();
    
    $post = Post::findOrFail($comment->post_id);

    return redirect()->route('posts.show', ['post' => $post]);
  }
}
