<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
//use Illuminate\Support\Str;
use App\Models\SubWarehouse;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subWarehouse = SubWarehouse::select('uuid')->get();

        return [        
            'int_cod' => $this->faker->regexify('[A-Z]{5}[0-9]{10}'),
            'name' => strtoupper($this->faker->word()),
            'sub_warehouse_uuid' => $subWarehouse->random()->uuid
        ];
    }
}

