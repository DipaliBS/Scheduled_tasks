<?php
/*Created by : Dipali Suryawanshi
Purpose: Create custom scheduled task
Date: 01-04-2025
*/
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\UserLocation;

class FetchRandomUsers extends Command {
    protected $signature = 'fetch:random-users';
    protected $description = 'Fetch 5 random users and store in the database';

    public function handle() {
        $response = Http::get('https://randomuser.me/api/', ['results' => 5]);

        if ($response->successful()) {
            $users = $response->json()['results'];

            foreach ($users as $userData) {
                $user = User::create([
                    'name' => $userData['name']['first'] . ' ' . $userData['name']['last'],
                    'email' => $userData['email'],
                ]);

                UserDetail::create([
                    'user_id' => $user->id,
                    'gender' => $userData['gender'],
                ]);

                UserLocation::create([
                    'user_id' => $user->id,
                    'city' => $userData['location']['city'],
                    'country' => $userData['location']['country'],
                ]);
            }
        }
    }
}
