<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';

    protected $fillable = [
        'user_id',
        'candidate',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
