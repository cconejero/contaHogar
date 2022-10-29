<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class CardBillingCycle extends Model
{
    use HasFactory;

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }

    public function spends()
    {
        return $this->hasMany(CardSpend::class);
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month)->addMonth();
        $generationDate = $this->card->getGenerationDate($date);

        $cardBillingCycle = CardBillingCycle::firstOrCreate([
            'card_id' => $this->card->id,
            'year' => $date->year,
            'month' => $date->month,
        ], [
            'generation_date' => $generationDate,
            'due_date' => $this->card->getDueDate($generationDate)
        ]);

        return $cardBillingCycle;
    }

    public function prevMonth()
    {
        $date = Carbon::create($this->year, $this->month)->subMonth();
        $generationDate = $this->card->getGenerationDate($date);

        $cardBillingCycle = CardBillingCycle::firstOrCreate([
            'card_id' => $this->card->id,
            'year' => $date->year,
            'month' => $date->month,
        ], [
            'generation_date' => $generationDate,
            'due_date' => $this->card->getDueDate($generationDate)
        ]);

        return $cardBillingCycle;
    }

    public function import()
    {
        if ($this->card->user->id === Auth::user()->id){
            $prevSpends = CardSpend::query()
                ->where([
                    ['card_billing_cycle_id', '=', $this->prevMonth()->id]
                ])
                ->where(function ($query) {
                    $query->whereColumn('actual_due', '<', 'total_due')
                        ->orWhere('fixed', true);
                })
                ->get();

            foreach ($prevSpends as $spend){

                $actual_due = $spend->actual_due;

                if ((!$spend->fixed) && ($spend->actual_due < $spend->total_due)){
                    $actual_due ++;
                }

                $cardSpend = CardSpend::firstOrCreate([
                    'card_billing_cycle_id' => $this->id,
                    'description' => $spend->description,
                    'amount' => $spend->amount,
                    'currency_id' => $spend->currency_id,
                    'fixed' => $spend->fixed,
                    'actual_due' => $actual_due,
                    'total_due' => $spend->total_due
                ]);
            }
        }

        return redirect('/billing_cycle/' . $this->id);
    }

    public function calculateImpuestoSellos(){
        $spends = CardSpend::query()
            ->where('card_billing_cycle_id', $this->id)
            ->whereNull('tax')
            ->get();

        $groups = $spends->groupBy('currency_id');

        $groupsWithSum = $groups->mapWithKeys(function ($group, $key){
            return [
                $key => round(($group->sum('amount') * 0.006), 2)
            ];
        });

        foreach ($groupsWithSum as $key => $value){
            CardSpend::updateOrCreate(
                [
                    'card_billing_cycle_id' => $this->id,
                    'description' => 'Impuesto Sello ' . Currency::find($key)->name,
                    'currency_id' => $key,
                    'fixed' => false,
                    'actual_due' => 1,
                    'total_due' => 1,
                    'tax' => 'impuesto_sello'
                ], [
                    'amount' => $value
                ]
            );
        }
    }

    public function calculateImpuestoPais(){
        $spends = CardSpend::query()
            ->where('card_billing_cycle_id', $this->id)
            ->where('currency_id', '!=', 1)
            ->whereNull('tax')
            ->get();

        $groups = $spends->groupBy('currency_id');

        $groupsWithSum = $groups->mapWithKeys(function ($group, $key){
            return [
                $key => round(($group->sum('amount') * 0.45), 2)
            ];
        });

        foreach ($groupsWithSum as $key => $value){
            CardSpend::updateOrCreate(
                [
                    'card_billing_cycle_id' => $this->id,
                    'description' => 'Impuesto País ' . Currency::find($key)->name,
                    'currency_id' => $key,
                    'fixed' => false,
                    'actual_due' => 1,
                    'total_due' => 1,
                    'tax' => 'impuesto_pais'
                ], [
                    'amount' => $value
                ]
            );
        }
    }

}
