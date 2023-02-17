<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Replie;

class FavoriteReplie extends Model
{
    protected $table = 'favorites_replie';
    public function isFavorite_replie($user_id, $replie_id) 
    {
        return $this->where('user_id', $user_id)->where('replie_id', $replie_id)->first();
    }

    public function storeFavorite_replie($user_id,  $replie_id)
    {
        $this->user_id = $user_id;
        $this->replie_id = $replie_id;
        $this->save();

        return;
    }

    public function destroyFavorite_replie($user_id,  $replie_id)
    {

        $this->user_id = $user_id;
        $this->replie_id = $replie_id;
        $this->where('user_id', $user_id)->where('replie_id', $replie_id)->delete();
        return;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
