<?php

namespace Infrastructure\Console;

use Api\Users\Console\AddUserCommand;
use Api\Users\Console\CheckoutDriverCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        AddUserCommand::class,
        CheckoutDriverCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
                  
        $schedule->command('drivers:checkout')
                 ->timezone('Asia/Jakarta')
                 ->dailyAt('17:00');
    }
}
