<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {

        $posts = Post::orderBy('created_at', 'DESC')->paginate(6);
        $categories = Category::all();

        $seo = [
            'seo_title' => 'Blog',
            'seo_description' => 'Our Blog',
        ];

        return view('blog.index', compact('posts', 'categories', 'seo'));
    }

    public function category($slug)
    {

        $category = Category::where('slug', '=', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('created_at', 'DESC')->paginate(6);
        $categories = Category::all();

        $seo = [
            'seo_title' => $category->name . '- Blog',
            'seo_description' => $category->name . '- Blog',
        ];

        return view('blog.index', compact('posts', 'category', 'categories', 'seo'));
    }

    public function post($category, $slug)
    {

        $post = Post::where('slug', '=', $slug)->firstOrFail();

        $seo = [
            'seo_title' => $post->title,
            'seo_description' => $post->seo_description,
        ];

        return view('blog.post', compact('post', 'seo'));
    }
}
