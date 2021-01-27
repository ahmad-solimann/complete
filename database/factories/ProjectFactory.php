<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user =User::factory()->create();
        $categories= array(1,2,3,4,5,6,7,8);

        return [
            'category_id' => $categories[array_rand($categories)],
            'style_id' => rand(1,9),
            'user_id' => $user->id,
            'name' => $this->faker->name,
            'project_director' => $this->faker->name,
            'address'=> $this->faker->address,
            'start_date'=>'2021-01-05',
            'end_date'=>'2021-01-05'
        ];
    }
}
