<?php

namespace App\Services;

use App\Mail\PostNotification;
use App\Models\Post;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NotificationService
{

    public function processPendingNotifications()
    {
        $missingDeliveries = DB::table('posts')
            ->crossJoin('subscriptions')
            ->leftJoin('subscription_deliveries', function ($join) {
                $join->on('posts.id', '=', 'subscription_deliveries.post_id')
                    ->on('subscriptions.id', '=', 'subscription_deliveries.subscription_id');
            })
            ->whereNull(['subscription_deliveries.post_id', 'subscription_deliveries.subscription_id'])
            ->select('posts.id as post_id', 'subscriptions.id as subscription_id')
            ->get();

        $subscriptionIds = array_unique(array_column($missingDeliveries->all(), 'subscription_id'));
        $subscriptions = Subscription::whereIn('id', $subscriptionIds)->get();
        $subscriptionMap = $subscriptions->keyBy('id')->all();

        $postIds = array_unique(array_column($missingDeliveries->all(), 'post_id'));
        $posts = Post::whereIn('id', $postIds)->get();
        $postMap = $posts->keyBy('id')->all();

        foreach ($missingDeliveries as $delivery) {
            DB::transaction(function () use ($delivery, $subscriptionMap, $postMap) {
                $subscription = $subscriptionMap[$delivery->subscription_id];
                $post = $postMap[$delivery->post_id];
                $subscription->postDeliveries()->attach($post->id);
                Mail::to($subscription->email)
                    ->queue(new PostNotification($post, $subscription));
            });
        }
    }

}
