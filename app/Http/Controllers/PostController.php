<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostService;

class PostController
{
    /**
     * Store a newly created post in storage.
     */
    public function store(StorePostRequest $request, PostService $postService)
    {
        $validated = $request->validated();
        $postService->createPost(
            $validated['title'],
            $validated['content'],
            $validated['website_domain'],
        );
        return response(status: 201);
    }
}
