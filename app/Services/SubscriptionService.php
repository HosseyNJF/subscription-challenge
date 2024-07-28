<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Subscription;
use App\Models\Website;

class SubscriptionService {

    public function createSubscription(string $email, string $domain) {
        $website = Website::where('domain', $domain)->firstOrFail();
        return Subscription::create([
            'email' => $email,
            'website_id' => $website->id,
        ]);
    }

}
