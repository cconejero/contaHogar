<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Card extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function spends()
    {
        return $this->hasMany(CardSpend::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
