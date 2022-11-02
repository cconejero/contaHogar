<?php

namespace App\Console;

use App\Models\Exchange;
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
            ->between('19:00', '19:19')
            ->name('Valor del dolar');

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
