<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = substr($this->faker->unique()->company(), 0, 32);

        return [
            'name' => $name,
            'description' => $this->faker->catchPhrase(),
            'tagfile' => generateFederationID($name).'.tag',
        ];
    }
}
