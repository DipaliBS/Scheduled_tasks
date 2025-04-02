<?php
/*Created by : Dipali Suryawanshi
Purpose: Added scheduled task in console as kernel.php is deprecated in laravel 11.0*
Date: 01-04-2025
*/
namespace App\Console;

use App\Console\Commands\FetchRandomUsers;

class Console
{
    public function schedule(\Illuminate\Console\Scheduling\Schedule $schedule): void
    {
        // Schedule the command to run every 5 minutes
        $schedule->command(FetchRandomUsers::class)->everyFiveMinutes();
    }
}

