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

    public static $rules = array(
        'comment' => ['required', 'string', 'max:255'],
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function my_user()
    {
        return $this->belongsTo(User::class,'my_id');
    }
    
}
