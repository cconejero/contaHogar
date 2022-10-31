<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function spends()
    {
        return $this->hasMany(AccountSpend::class, 'account_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }


    public function actualBillingCycle()
    {
        $date = Carbon::now();

        $accountCycle = AccountCycle::firstOrCreate([
            'account_id' => $this->id,
            'month' => $date->month,
            'year' => $date->year
        ]);

        return $accountCycle;
    }
}
