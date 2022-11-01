<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\Bank;
use App\Models\Card;
use App\Models\CardBrand;
use App\Models\Currency;
use App\Models\Movement;
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

        $patagonia = Bank::factory()->create([
            'name' => 'Patagonia'
        ]);

        $frances = Bank::factory()->create([
            'name' => 'Frances'
        ]);

        Bank::factory()->create([
            'name' => 'Nación'
        ]);

        $visa = CardBrand::factory()->create([
            'name' => 'Visa'
        ]);

        $master = CardBrand::factory()->create([
            'name' => 'Master'
        ]);

        AccountType::factory()->create([
            'name' => 'Cuenta Corriente'
        ]);

        $CA = AccountType::factory()->create([
            'name' => 'Caja de Ahorro'
        ]);

        $peso = Currency::factory()->create([
            'name' => 'Peso',
            'sign' => 'AR$'
        ]);

        $dolar = Currency::factory()->create([
            'name' => 'Dolar',
            'sign' => 'U$D'
        ]);

        Movement::factory()->create([
            'name' => 'Ingreso'
        ]);

        Movement::factory()->create([
            'name' => 'Gasto'
        ]);

        $this->call([
            TagSeeder::class,
        ]);
    }
}
