<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'score_a',
        'score_b',
        'score_c',
        'score_d',
        'score_e',
        'final_category',
        'final_category_name',
        'rolling_list',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
