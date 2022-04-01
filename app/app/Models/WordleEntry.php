<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordleEntry extends Model
{
    use HasFactory;

    protected $table = 'wordle';

    protected $fillable = [
        'user_id', 'date', 'attempts'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
