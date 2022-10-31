<?php

namespace App\Models;

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
}
