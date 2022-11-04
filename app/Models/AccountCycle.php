<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccountCycle extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function spends()
    {
        return $this->hasMany(AccountSpend::class);
    }


    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month)->addMonth();

        $accountCycle = AccountCycle::firstOrCreate([
            'account_id' => $this->account->id,
            'year' => $date->year,
            'month' => $date->month,
        ]);

        return $accountCycle;
    }

    public function prevMonth()
    {
        $date = Carbon::create($this->year, $this->month)->subMonth();

        $accountcycle = AccountCycle::firstOrCreate([
            'account_id' => $this->account->id,
            'year' => $date->year,
            'month' => $date->month,
        ]);

        return $accountcycle;
    }

    public function import()
    {
        if ($this->account->user->id === Auth::user()->id){
            $prevSpends = AccountSpend::query()
                ->where([
                    ['account_cycle_id', '=', $this->prevMonth()->id]
                ])
                ->get();

            $totalPrevSpend = 0;

            foreach ($prevSpends as $spend){

                $totalPrevSpend += ($spend->movement_id === 2) ? (-1 * $spend->amount) : $spend->amount;

            }

            AccountSpend::updateOrCreate([
                'account_cycle_id' => $this->id,
                'description' => 'Saldo del mes anterior',
            ], [
                'amount' => abs($totalPrevSpend),
                'movement_id' => ($totalPrevSpend < 0 ? 2 : 1)
            ]);
        }

        return redirect('/account_cycle/' . $this->id);
    }

    public function getTotal()
    {
        $total = 0;

        foreach($this->spends as $spend){
            $total += ($spend->movement_id === 2 ? -1 * $spend->amount : $spend->amount);
        }

        return $total;
    }

}
