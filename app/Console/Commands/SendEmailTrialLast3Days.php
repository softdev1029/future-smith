<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Log;
use DB;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Log as Logging;

class SendEmailTrialLast3Days extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendEmailTrialLast3Days:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::debug('SendEmailTrialLast3Days:handle()');

        // Check trial period
        $subscriptions = Subscription::whereNull('ends_at')
                                     ->whereRaw(DB::raw('DATEDIFF(trial_ends_at, NOW()) <= 3'))
                                     ->whereRaw(DB::raw('trial_ends_at > NOW()'))
                                     ->where('is_sent_email_trial_last_3_days', '<>', 1)
                                     ->get();

        foreach ($subscriptions as $subscription) {
            $user = $subscription->user;

            // Email to this user
            // How to check:
            // In command line,
            // php artisan SendEmailTrialLast3Days:run
            $user->sendMembershipExpireNotification();

            $subscription->is_sent_email_trial_last_3_days = 1;
            $subscription->save();
        }
    }
}
