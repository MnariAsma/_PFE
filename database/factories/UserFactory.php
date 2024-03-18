<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name' => 'nejib',
            'last_name'=> 'mn',
            'email' => 'superadmin1@gmail.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'cin'=>"1402255",
            'phone'=>"97815622",
            'role'=>'super_admin'
        
          
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
