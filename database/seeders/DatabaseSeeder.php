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

        $visa = CardBrand::factory()->create([
            'name' => 'Visa'
        ]);

        $master = CardBrand::factory()->create([
            'name' => 'Master'
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'card_brand_id' => $visa,
            'name' => 'Visa Claudio',
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'card_brand_id' => $master,
            'name' => 'Master Claudio',
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'card_brand_id' => $visa,
            'name' => 'Visa Vikky',
        ]);

        Card::factory()->create([
            'bank_id' => $patagonia,
            'user_id' => $claudio,
            'card_brand_id' => $master,
            'name' => 'Master Vikky',
        ]);

        $frances = Bank::factory()->create([
            'name' => 'Frances'
        ]);

        Card::factory()->create([
            'bank_id' => $frances,
            'user_id' => $claudio,
            'card_brand_id' => $visa,
            'name' => 'Visa Frances',
        ]);

        Card::factory()->create([
            'bank_id' => $frances,
            'user_id' => $pepe,
            'card_brand_id' => $master,
            'name' => 'Esta no va.',
        ]);

        Bank::factory()->create([
            'name' => 'Nación'
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

        Currency::factory()->create([
            'name' => 'Dolar',
            'sign' => 'U$D'
        ]);

        Account::factory()->create([
            'description' => 'CA Claudio Pesos Patagonia',
            'alias' => 'RUBIA.EUROPA.NAIPE',
            'cbu' => '0340230808230016904003',
            'bank_id' => $patagonia,
            'account_type_id' => $CA,
            'currency_id' => $peso,
            'user_id' => $claudio
        ]);

        Account::factory()->create([
            'description' => 'CA Claudio Dolares Patagonia',
            'alias' => 'TORRE.CLAVE.TE',
            'cbu' => '0340230809230016904004',
            'bank_id' => $patagonia,
            'account_type_id' => $CA,
            'currency_id' => $peso,
            'user_id' => $claudio
        ]);

        Movement::factory()->create([
            'name' => 'Ingreso'
        ]);

        Movement::factory()->create([
            'name' => 'Gasto'
        ]);

    }
}
