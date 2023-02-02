<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Job;
use App\Models\Customer;
use App\Models\Verification;
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


        for ($i = 0; $i < 25; $i++) {
            $verification = Verification::factory()->create();
            if ($verification->status) {
                Customer::factory()
                    ->create([
                        'username' => $verification->phone,
                        'password' => bcrypt($verification->code),
                        'created_at' => $verification->created_at,
                    ]);
            }
        }

        Job::factory()->count(80)->create();

    }
}
