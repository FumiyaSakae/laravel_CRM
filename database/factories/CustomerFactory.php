<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tel = str_replace('-', '', $this->faker->phoneNumber);
        $address = mb_substr($this->faker->address, 9);

        return [
            'company_name' => $this->faker->company,
            'pic_name' => $this->faker->name,
            'pic_kana'=> $this->faker->kanaName,
            'gender'=> $this->faker->numberBetween(0, 2),
            'tel' => $tel,
            'email' => $this->faker->email,
            'postcode' => $this->faker->postcode,
            'address' => $address,
            'startDate' => $this->faker->dateTime,
            'memo' => $this->faker->realText(50),
        ];
    }
}
