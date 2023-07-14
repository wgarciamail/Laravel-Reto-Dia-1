<?php

namespace App\Http\Controllers;

use \App\Models\Post;
class PageController extends Controller
{
    public function blog()
    {
        $pages = Post::where('type', 'PAGE')->get();
        $posts = post::where('type', 'POST')->orderBy('id')->get();
        return view('blog', compact('pages', 'posts'));
    }

    public function post(Post $post)
    {
        $pages = Post::whereType('PAGE')->get();
        return view('post', compact('pages', 'post'));
    }
}
