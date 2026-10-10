<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScratchCardLead extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scratchCard()
    {
        return $this->belongsTo(ScratchCard::class, 'scratch_card_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
