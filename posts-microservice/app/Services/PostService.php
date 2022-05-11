<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Services\UserService;

class PostService
{
    // Create a new Post for user
    public function createPost(array $data)
    {
        $user = (new UserService())->get('user');
        return Post::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $user['data']['id'],
            'publication_date' => $data['publication_date'],
        ]);
    }

    // Get single user post
    public function getUserPosts(string $sortBy) : array|Collection
    {
        $user = (new UserService())->get('user');
        // fetch all user post and sort by publication_date
        return Post::query()
                    ->where('user_id', $user['data']['id'])
                    ->orderBy('publication_date', $sortBy)
                    ->get();
    }

    // Get all posts
    public function getPosts(string $sortBy) : array|Collection
    {
        // fetch all posts and sort by publication_date
        return Post::query()
                    ->orderBy('publication_date', $sortBy)
                    ->get();
    }

    // Create multiple posts for admin user
    public function importMultiplePosts($data)
    {
        $adminUserId = (new UserService())->get('getUserAdmin')['data']['id'];

        // import multiple posts for admin user
        collect($data)->each(function ($post) use ($adminUserId) {
            Post::query()->create([
                'title' => $post['title'],
                'description' => $post['description'],
                'user_id' => $adminUserId,
                'publication_date' => $post['publication_date'],
            ]);
        });
    }
}
