<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class House_State extends Model
{
protected $guarded;

public function house(){
        return $this->belongsTo(Available_Houses::class);
 }
 public function user(){
        return $this->belongsTo(Available_Houses::class);
 }
}
