<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
}
