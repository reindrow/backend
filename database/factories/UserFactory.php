<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName(),
            'password' => bcrypt($this->faker->password()),
            'no_telp'=>$this->faker->phoneNumber(), 
            'tanggal_lahir'=>$this->faker->date(),
            'jenis_kelamin'=>$this->faker->randomElement(['laki-laki','perempuan']),
            'alamat'=>$this->faker->address(),
            'email' => $this->faker->unique()->safeEmail,
            'id_role'=> $this->faker->numberBetween(1,3),
        ];
    }
}
