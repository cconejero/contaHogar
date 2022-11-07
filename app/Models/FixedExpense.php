<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedExpense extends Model
{
    use HasFactory;

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function cycles()
    {
        return $this->belongsTo(FixedExpenseCycle::class);
    }

    public function currentCycle()
    {
        $date = Carbon::now()->day($this->due_date);

        $fixedExpenseCycle = FixedExpenseCycle::firstOrCreate([
            'fixed_expense_id' => $this->id,
            'month' => $date->month,
            'year' => $date->year,
            'due_date' => $date->format('Y-m-d'),
        ]);

        return $fixedExpenseCycle;
    }
}
