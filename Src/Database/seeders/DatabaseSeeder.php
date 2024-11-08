<?php

namespace Modules\Chats\Src\Database\Seeders; // Make sure this matches exactly

use Illuminate\Database\Seeder; 
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([ 
            AdminSeeder::class,
        ]);
    }
}
