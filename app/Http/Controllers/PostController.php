<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostFullResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()->orderBy('id', 'DESC')->get();

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return PostFullResource::make($post);
    }

    public function categories()
    {
        // SELECT id, name FROM categories ORDER BY name ASC
        return Category::query()->select(['id', 'name'])->orderBy('name', 'ASC')->get();
    }

    public function store(PostRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());
        $post->fillImage($request->file('image'));

        return PostResource::make($post);
    }

    public function update(Post $post, PostUpdateRequest $request)
    {
        if($post->user_id == Auth::id()) {
            $post->update($request->validated());
            if($request->file('image')) {
                $post->fillImage($request->file('image'));
            }
        }

        return PostResource::make($post);
    }

    public function delete(Post $post)
    {
        if($post->user_id == Auth::id()) {
            $post->delete();
        }

        return response()->noContent();
    }
}
