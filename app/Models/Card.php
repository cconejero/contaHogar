<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Type\Integer;

class Card extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function spends()
    {
        return $this->hasMany(CardSpend::class, 'card_id', 'id');
    }

    public function brand(){
        return $this->belongsTo(CardBrand::class, 'card_brand_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param Card $card
     * @param Integer $month
     * @param Integer $year
     * @return mixed
     */
    public static function calculateImpuestoSellos(Card $card, int $month, int $year){
        $spends = CardSpend::query()
            ->where('card_id', $card->id)
            ->where('month', $month)
            ->where('year', $year)
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
                    'description' => 'Impuesto Sello ' . Currency::find($key)->name,
                    'month' => $month,
                    'year' => $year,
                    'card_id' => $card->id,
                    'actual_due' => 1,
                    'total_due' => 1,
                    'currency_id' => $key,
                    'tax' => 'impuesto_sello'
                ], [
                    'amount' => $value
                ]
            );
        }
    }
}
