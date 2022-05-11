<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Create a new Post
     */
    public function createPost(CreatePostRequest $request) : JsonResponse
    {
        try {
            $post = $this->postService->createPost($request->validated());
            return response()->success($post, 'Post created successfully');
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 'Error creating post');
        }
    }

    /**
     * Get all User Posts
     */
    public function getUserPosts(Request $request) : JsonResponse
    {
        $validatedData = $request->validate([
            'sortBy' => 'nullable|string|in:desc,asc',
        ]);

        try {
            $posts = $this->postService->getUserPosts($validatedData['sortBy'] ?? 'asc');
            return PostResource::collection($posts)->response()->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 'Error retrieving posts');
        }
    }

    /**
     * Get all Posts
     */
    public function getPosts(Request $request) : JsonResponse
    {
        $validatedData = $request->validate([
            'sortBy' => 'nullable|string|in:desc,asc',
        ]);

        try {
            $posts = $this->postService->getPosts($validatedData['sortBy'] ?? 'asc');
            return PostResource::collection($posts)->response()->setStatusCode(200);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 'Error retrieving posts');
        }
    }
}
