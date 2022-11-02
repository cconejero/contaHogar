<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'fecha' => "2022-10-28",
                'compra' => 154.59,
                'venta' => 162.59
            ],
            [
                'fecha' => "2022-10-27",
                'compra' => 154.3,
                'venta' => 162.3
            ],
            [
                'fecha' => "2022-10-26",
                'compra' => 154.22,
                'venta' => 162.22
            ],
            [
                'fecha' => "2022-10-25",
                'compra' => 154.1,
                'venta' => 162.1
            ],
            [
                'fecha' => "2022-10-24",
                'compra' => 153.56,
                'venta' => 161.56
            ],
            [
                'fecha' => "2022-10-21",
                'compra' => 152.57,
                'venta' => 160.57
            ],
            [
                'fecha' => "2022-10-20",
                'compra' => 152.27,
                'venta' => 160.27
            ],
            [
                'fecha' => "2022-10-19",
                'compra' => 151.94,
                'venta' => 159.94
            ],
            [
                'fecha' => "2022-10-18",
                'compra' => 151.71,
                'venta' => 159.71
            ],
            [
                'fecha' => "2022-10-17",
                'compra' => 151.49,
                'venta' => 159.49
            ],
            [
                'fecha' => "2022-10-14",
                'compra' => 150.28,
                'venta' => 158.28
            ],
            [
                'fecha' => "2022-10-13",
                'compra' => 150.19,
                'venta' => 158.19
            ],
            [
                'fecha' => "2022-10-12",
                'compra' => 149.88,
                'venta' => 157.88
            ],
            [
                'fecha' => "2022-10-11",
                'compra' => 149.76,
                'venta' => 157.76
            ],
            [
                'fecha' => "2022-10-06",
                'compra' => 148.29,
                'venta' => 156.29
            ],
            [
                'fecha' => "2022-10-05",
                'compra' => 147.9,
                'venta' => 155.9
            ],
            [
                'fecha' => "2022-10-04",
                'compra' => 147.67,
                'venta' => 155.67
            ],
            [
                'fecha' => "2022-10-03",
                'compra' => 147.33,
                'venta' => 155.33
            ],
            [
                'fecha' => "2022-09-30",
                'compra' => 146.25,
                'venta' => 154.25
            ],
            [
                'fecha' => "2022-09-29",
                'compra' => 145.9,
                'venta' => 153.9
            ],
            [
                'fecha' => "2022-09-28",
                'compra' => 145.61,
                'venta' => 153.61
            ],
            [
                'fecha' => "2022-09-27",
                'compra' => 145.31,
                'venta' => 153.31
            ],
            [
                'fecha' => "2022-09-26",
                'compra' => 145.01,
                'venta' => 153.01
            ],
            [
                'fecha' => "2022-09-23",
                'compra' => 144.24,
                'venta' => 152.24
            ],
            [
                'fecha' => "2022-09-22",
                'compra' => 143.64,
                'venta' => 151.64
            ],
            [
                'fecha' => "2022-09-21",
                'compra' => 143.56,
                'venta' => 151.56
            ],
            [
                'fecha' => "2022-09-20",
                'compra' => 143.24,
                'venta' => 151.24
            ],
            [
                'fecha' => "2022-09-19",
                'compra' => 142.93,
                'venta' => 150.93
            ],
            [
                'fecha' => "2022-09-16",
                'compra' => 142.17,
                'venta' => 150.17
            ],
            [
                'fecha' => "2022-09-15",
                'compra' => 143.99,
                'venta' => 149.99
            ],
            [
                'fecha' => "2022-09-14",
                'compra' => 143.61,
                'venta' => 149.61
            ],
            [
                'fecha' => "2022-09-13",
                'compra' => 143.52,
                'venta' => 149.52
            ],
            [
                'fecha' => "2022-09-12",
                'compra' => 143.43,
                'venta' => 149.43
            ],
            [
                'fecha' => "2022-09-09",
                'compra' => 142.42,
                'venta' => 148.42
            ],
            [
                'fecha' => "2022-09-08",
                'compra' => 142.15,
                'venta' => 148.15
            ],
            [
                'fecha' => "2022-09-07",
                'compra' => 141.68,
                'venta' => 147.68
            ],
            [
                'fecha' => "2022-09-06",
                'compra' => 141.35,
                'venta' => 147.35
            ],
            [
                'fecha' => "2022-09-05",
                'compra' => 141.05,
                'venta' => 147.05
            ],
            [
                'fecha' => "2022-09-01",
                'compra' => 139.86,
                'venta' => 145.86
            ],
            [
                'fecha' => "2022-08-31",
                'compra' => 139.77,
                'venta' => 145.77
            ],
            [
                'fecha' => "2022-08-30",
                'compra' => 139.62,
                'venta' => 145.62
            ],
            [
                'fecha' => "2022-08-29",
                'compra' => 139.45,
                'venta' => 145.45
            ],
            [
                'fecha' => "2022-08-26",
                'compra' => 138.73,
                'venta' => 144.73
            ],
            [
                'fecha' => "2022-08-25",
                'compra' => 138.58,
                'venta' => 144.58
            ],
            [
                'fecha' => "2022-08-24",
                'compra' => 138.29,
                'venta' => 144.29
            ],
            [
                'fecha' => "2022-08-23",
                'compra' => 138.04,
                'venta' => 144.04
            ],
            [
                'fecha' => "2022-08-22",
                'compra' => 138.04,
                'venta' => 144.04
            ],
            [
                'fecha' => "2022-08-19",
                'compra' => 137.06,
                'venta' => 143.06
            ],
            [
                'fecha' => "2022-08-18",
                'compra' => 136.39,
                'venta' => 142.39
            ],
            [
                'fecha' => "2022-08-17",
                'compra' => 136.52,
                'venta' => 142.52
            ],
            [
                'fecha' => "2022-08-16",
                'compra' => 136.41,
                'venta' => 142.41
            ],
            [
                'fecha' => "2022-08-12",
                'compra' => 135.5,
                'venta' => 141.5
            ],
            [
                'fecha' => "2022-08-11",
                'compra' => 134.98,
                'venta' => 140.98
            ],
            [
                'fecha' => "2022-08-10",
                'compra' => 134.77,
                'venta' => 140.77
            ],
            [
                'fecha' => "2022-08-09",
                'compra' => 134.77,
                'venta' => 140.77
            ],
            [
                'fecha' => "2022-08-08",
                'compra' => 134.49,
                'venta' => 140.49
            ],
            [
                'fecha' => "2022-08-05",
                'compra' => 133.89,
                'venta' => 139.89
            ],
            [
                'fecha' => "2022-08-04",
                'compra' => 133.86,
                'venta' => 139.86
            ],
            [
                'fecha' => "2022-08-03",
                'compra' => 133.31,
                'venta' => 139.31
            ],
            [
                'fecha' => "2022-08-02",
                'compra' => 133.07,
                'venta' => 139.07
            ],
            [
                'fecha' => "2022-08-01",
                'compra' => 132.9,
                'venta' => 138.9
            ]
        ];

        foreach ($values as $value){
            Exchange::factory()->create([
                'currency_id' => 2,
                'date' => $value['fecha'],
                'value' => $value['venta'],
            ]);
        }
    }
}
