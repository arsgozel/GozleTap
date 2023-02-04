<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Job;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
            AttributeValueSeeder::class,
        ]);

        Contact::factory()->count(10)->create();
        Job::factory()->count(80)->create();

    }
}
