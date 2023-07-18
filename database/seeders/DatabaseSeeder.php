<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Customer;
use \App\Models\Purchase;
use \App\Models\Hr;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            HrSeeder::class,
        ]);

        Customer::factory(100)->create();

        $hrs = Hr::all();

        Purchase::factory(100)->create()
        ->each(function(Purchase $purchase) use ($hrs){
            $purchase->hrs()->attach(
            $hrs->random(rand(1,3))->pluck('id')->toArray(),
            ['quantity' => rand(1, 12)]
            );
        });
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
