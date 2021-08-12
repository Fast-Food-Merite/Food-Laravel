<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Food;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->has(Food::factory()->count(4))->count(10)->create();

        Role::factory()->count(4)->create();

        // User::factory()->has(Role::factory()->count(5))->count(2)->create();
    }
}
