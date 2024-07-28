<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Services\SubscriptionService;

class SubscriptionController
{
    /**
     * Store a newly created subscription in storage.
     */
    public function store(StoreSubscriptionRequest $request, SubscriptionService $subscriptionService)
    {
        $validated = $request->validated();
        $subscriptionService->createSubscription(
            $validated['email'],
            $validated['domain'],
        );
        return response(status: 201);
    }
}
