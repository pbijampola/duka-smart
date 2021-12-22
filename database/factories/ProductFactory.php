<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(3,false),
            'slug'=>$this->faker->unique()->slug,
            'summary'=>$this->faker->text,
            'description'=>$this->faker->text,
            'stock'=>$this->faker->numberBetween(2,10),
            'price'=>$this->faker->randomFloat(10,2),
            'discount'=>$this->faker->randomFloat(10,2),
            'offer_price'=>$this->faker->randomFloat(10,2),
            'photo'=>$this->faker->imageUrl(100,100),
            'size'=>$this->faker->randomElement(['S','M','L','XL','XXL']),
            'weight'=>$this->faker->numberBetween(0,100),
            'condition'=>$this->faker->randomElement(['new','used','popular','hot','winter']),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'vendor_id'=>$this->faker->randomElement(User::pluck('id')->toArray()),
            'category_id'=>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'brand_id'=>$this->faker->randomElement(Brand::pluck('id')->toArray()),



        ];
    }
}
