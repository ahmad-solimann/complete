<?php

namespace Database\Factories;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class QuestionnaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questionnaire::class;

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
//            'style_id' => rand(1,9),
            'user_id' => $user->id,
            'project_name' => $this->faker->name,
            'project_description' => $this->faker->paragraph(4),
            'project_address'=> $this->faker->address,
            'budget_range' => rand(1,4).'000-'.rand(5,7).'000$',
        ];
    }
}
