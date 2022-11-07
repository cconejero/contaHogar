<?php

namespace App\Console;

use App\Http\Controllers\FixedExpenseCycleController;
use App\Models\Exchange;
use App\Models\FixedExpense;
use App\Models\FixedExpenseCycle;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // Actualizar el valor del dolar
        $schedule->call(function () {
            $response = Http::withToken(env('API_BCRA'))
                ->get('https://api.estadisticasbcra.com/usd_of_minorista')
                ->json();

            $today = $response[count($response) - 1];

            Exchange::firstOrCreate([
                'currency_id' => 2,
                'date' => $today['d']
            ], [
                'value' => $today["v"]
            ]);
        })
            ->timezone('America/Argentina/Ushuaia')
            ->between('6:00', '6:19')
            ->name('Valor del dolar');



        // Crear Gastos Fijos
        $schedule->call(function (){
            $fixedExpenses = FixedExpense::all();

            foreach ($fixedExpenses as $fixedExpense){
                $currentCycle = $fixedExpense->currentCycle();

                $currentCycle->createDue();
            }
        })
            ->timezone('America/Argentina/Ushuaia')
            ->monthlyOn(1)
            ->between('7:00', '7:19')
            ->name('Crear Gastos Fijos');


        // Cobrar gastos fijos vencidos.
        $schedule->call(function (){
            $cycles = FixedExpenseCycle::query()
                ->where('due_date', '=', now()->format('Y-m-d'));

            foreach ($cycles as $cycle){
                $account = $cycle->fixedExpense()->account;
                if ($account !== null){
                    $cycle->pay($account);
                }
            }
        });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
