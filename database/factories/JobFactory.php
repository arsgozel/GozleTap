<?php

namespace Database\Factories;

use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class JobFactory extends Factory
{
    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Job $product) {
            //
        })->afterCreating(function (Job $product) {
            //
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $category = Category::doesntHave('child')->inRandomOrder()->first();
        $customer = Customer::inRandomOrder()->first();
        $location = Location::inRandomOrder()->first();
        $gender = AttributeValue::where('attribute_id', 1)->inRandomOrder()->first();
        $education = AttributeValue::where('attribute_id', 2)->inRandomOrder()->first();
        $workTime = AttributeValue::where('attribute_id', 3)->inRandomOrder()->first();
        $experience = AttributeValue::where('attribute_id', 4)->inRandomOrder()->first();

        $nameTm = fake()->streetName();
        $nameEn = null;

        $fullNameTm = $nameTm . ' '
            . $category->name_tm . ' ';

        return [
            'customer_id' => $customer->id,
            'category_id' => $category->id,
            'gender_id' => $gender->id,
            'experience_id' => $experience->id,
            'work_time_id' => $workTime->id,
            'education_id' => $education->id,
            'location_id' => $location->id,
            'name_tm' => $nameTm,
            'name_en' => $nameEn,
            'full_name_tm' => $fullNameTm,
            'slug' => str()->slug($fullNameTm) . '-' . str()->random(10),
            'salary' => rand(0, 10000),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTimeBetween('-2 month', 'now')->format('Y-m-d H:i:s'),
            'phone' => fake()->unique()->numberBetween(61000000, 65999999),
            'email' => fake()->unique()->safeEmail(),
            'viewed' => rand(20, 200),
            'favorites' => rand(0, 30),
            'description' => fake()->text(rand(100, 200)),
        ];
    }
}
