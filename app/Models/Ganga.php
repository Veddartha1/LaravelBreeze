<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ganga extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function likes() {
        return $this->belongsToMany('App\Models\User', 'likes', 'ganga_id', 'user_id')->withPivot('liked', 'unliked')->where('user_id', '=' , Auth::id());
    }

}
