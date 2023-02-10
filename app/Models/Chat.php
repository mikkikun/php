<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Chat extends Model
{
    protected $fillable = [
        'comment'
    ];

    protected $guarded = [
        'create_at', 'update_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
