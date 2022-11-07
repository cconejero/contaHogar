<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FixedExpenseCycle extends Model
{
    use HasFactory;

    public function spends()
    {
        return $this->hasMany(FixedExpenseSpends::class);
    }

    public function fixedExpense()
    {
        return $this->belongsTo(FixedExpense::class);
    }

    public function getTotal()
    {
        $total = 0;

        foreach($this->spends as $spend){
            $total += $spend->amount;
        }

        return $total;
    }

    public function createDue()
    {
        $fixedExpense = $this->fixedExpense;

        if (!$this->paid){

            $fixedExpenseSpend = FixedExpenseSpends::updateOrCreate([
                'fixed_expense_cycle_id' => $this->id,
                'description' => $fixedExpense->description,
            ], [
                'amount' => $fixedExpense->amount,
                'tag_id' => $fixedExpense->tag->id,
            ]);
        }

    }

    public function pay(Account $account)
    {
        if (!$this->paid){
            $this->paid = true;

            $description = $this->fixedExpense->description . ' ' . $this->month . '/' . $this->year;

            AccountSpend::create([
                'account_cycle_id' => $account->actualBillingCycle()->id,
                'description' => $description,
                'amount' => $this->getTotal(),
                'movement_id' => 2,
            ]);

            $this->save();
        }
    }
}
