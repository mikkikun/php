<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Follow extends Model
{
    protected $primaryKey = [
        'following_id',
        'followed_id'
        ];
    protected $fillable = [
        'following_id',
        'followed_id'
        ];
    public $timestamps = false;
    public $incrementing = false;


}
