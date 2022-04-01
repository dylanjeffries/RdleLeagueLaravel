<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NerdleEntry extends Model
{
    use HasFactory;

    protected $table = 'nerdle';

    protected $fillable = [
        'user_id', 'date', 'attempts'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
