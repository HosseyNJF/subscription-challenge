<?php

namespace App\Console\Commands;

use App\Services\NotificationService;
use Illuminate\Console\Command;

class ProcessSubscriptionNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-subscription-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Put pending posts in queue for subscriptions that haven\'t received them';

    /**
     * Execute the console command.
     */
    public function handle(NotificationService $notificationService)
    {
        $notificationService->processPendingNotifications();
        $this->info("Processed successfully!");
    }
}
