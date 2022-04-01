<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\WordleEntry;
use App\Models\NerdleEntry;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)
        ->has(
            WordleEntry::factory()->count(5)->state(new Sequence(
                ['date' => '2022-03-29'],
                ['date' => '2022-03-28'],
                ['date' => '2022-03-27'],
                ['date' => '2022-03-26'],
                ['date' => '2022-03-25'],
            ))
        )->has(
            NerdleEntry::factory()->count(5)->state(new Sequence(
                ['date' => '2022-03-29'],
                ['date' => '2022-03-28'],
                ['date' => '2022-03-27'],
                ['date' => '2022-03-26'],
                ['date' => '2022-03-25'],
            ))
        )->create();
    }
}


// Users
// $users_to_seed = 4;
// $users = array();
// for ($i = 0; $i < $users_to_seed; $i++) {
//     array_push($users, [
//         'name' => Str::random(10),
//         'email' => Str::random(10).'@email.com',
//         'password' => Hash::make('password'),
//     ]);
// }
// DB::table('users')->insert($users);

// // Wordle
// $days_to_seed = 5;
// $wordle = array();
// for ($i = 0; $i < $days_to_seed; $i++) {
//     // Day
//     $day = date("Y-m-d", strtotime("-$i days"));
    
//     foreach ($users as $user) {
        
//     }
// }

// DB::table('wordle')->insert([
//     'user_id' => Str::random(10),
//     'attempts' => Str::random(10).'@email.com',
//     'password' => Hash::make('password'),
// ]);
