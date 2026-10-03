<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleFeedbackTemplate extends Model
{
    use HasFactory;

    protected $table = 'google_feedback_templates';

    protected $fillable = [
        'user_id',
        'feedback_text',
        'sort_order',
        'status',
    ];
}
