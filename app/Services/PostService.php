<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Website;

class PostService {

    public function createPost(string $title, string $content, string $websiteDomain) {
        $website = Website::where('domain', $websiteDomain)->first();
        if (!$website) {
            $website = Website::create(['domain' => $websiteDomain]);
        }
        return Post::create([
            'title' => $title,
            'content' => $content,
            'website_id' => $website->id,
        ]);
    }

}
