<?php

namespace App\Console;

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
        //
        'App\Console\Commands\SyncGoods',
        'App\Console\Commands\SyncJoke',
        'App\Console\Commands\SyncNews',
        'App\Console\Commands\SyncTodayHistory',
        'App\Console\Commands\SyncFood',
        'App\Console\Commands\SyncPraiseBat',
        'App\Console\Commands\SyncCom',
        'App\Console\Commands\SyncMd'

    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync-jd')->cron('0 */2 * * *');
        $schedule->command('sync:news')->cron('0 */2 * * *');
        $schedule->command('sync:joke')->daily();
        $schedule->command('sync:today:history')->cron('0 */12 * * *');
        $schedule->command('sync-food')->everyMinute();
        $schedule->command('sync:praise:bat')->everyFiveMinutes();
        $schedule->command('sync:com')->everyFiveMinutes();
        $schedule->command('sync:md')->everyFiveMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
