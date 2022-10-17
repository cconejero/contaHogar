<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bank;
use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(100)->create();

        $claudio = User::factory()->create([
            'name' => 'Claudio Conejero',
            'email' => 'conejero.claudio@gmail.com',
            'password' => 'password'
        ]);

        $pepe = User::factory()->create([
            'name' => 'Pepe Lepew',
            'email' => 'pepe@lepew.com',
            'password' => 'password'
        ]);

        $patagonia = Bank::factory()->create([
            'name' => 'Patagonia'
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'name' => 'Visa Claudio',
            'brand' => 'Visa'
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'name' => 'Master Claudio',
            'brand' => 'Master'
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'name' => 'Visa Vikky',
            'brand' => 'Visa'
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'name' => 'Master Vikky',
            'brand' => 'Master'
        ]);

        $frances = Bank::factory()->create([
            'name' => 'Frances'
        ]);

        Card::factory()->create([
            'bank_id' => $frances,
            'user_id' => $claudio,
            'name' => 'Visa Frances',
            'brand' => 'Visa'
        ]);

        Card::factory()->create([
            'bank_id' => $frances,
            'user_id' => $pepe,
            'name' => 'Esta no va.',
            'brand' => 'Master'
        ]);

        Bank::factory()->create([
            'name' => 'Nación'
        ]);

    }
}
