<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Available_Houses extends Model
{
protected $guarded;

public function states(){
    return $this->hasMany(House_State::class);
}
}
