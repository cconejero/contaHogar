<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function billingCycles()
    {
        return $this->hasMany(CardBillingCycle::class);
    }

    public function brand(){
        return $this->belongsTo(CardBrand::class, 'card_brand_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGenerationDate(Carbon $date){
        $generationDate = Carbon::create($date->year, $date->month, $this->generation_day_number);
        $generationDate->next($this->generation_day_name);
        return $generationDate;
    }

    public function getDueDate(Carbon $date){
        $dueDate = Carbon::create($date->year, $date->month, $date->day)->addWeek();
        $dueDate->next($this->due_day_name);
        return $dueDate;
    }

    public function actualBillingCycle()
    {
        $date = Carbon::create(now()->year, now()->month, 1);
        $generationDate = $this->getGenerationDate($date);

        return CardBillingCycle::firstOrCreate([
            'card_id' => $this->id,
            'month' => $date->month,
            'year' => $date->year
        ], [
            'generation_date' => $generationDate,
            'due_date' => $this->getDueDate($generationDate)
        ]);
    }
}
