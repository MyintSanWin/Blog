<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $user= User::factory()->create([
            'name'=>'John Smith',


        ]);
         Post::factory(5)->create([
             'user_id'=> $user->id
         ]);

    }

}

