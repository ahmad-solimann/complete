<?php

namespace Database\Factories;

use App\Models\User;
use App\Notifications\RegisteredUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user= [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'verified' => $this->faker->boolean,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'first_name'=> $this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'city'=>$this->faker->city,
            'address_1'=> $this->faker->address,
            'address_2'=> $this->faker->address,
            'phone' => $this->faker->phoneNumber
        ];
        //$admins = User::where('user_role',User::ADMIN_ROLE)->get();
        //Notification::send($admins, new RegisteredUser($user));
        return $user;
    }
}
