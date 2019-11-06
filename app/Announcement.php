<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}
