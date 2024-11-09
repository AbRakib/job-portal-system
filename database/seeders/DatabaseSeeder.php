<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory(5)->create();
        Category::factory(10)->create();
        JobType::factory(10)->create();
        Job::factory(100)->create();
    }
}
