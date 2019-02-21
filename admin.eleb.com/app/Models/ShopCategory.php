<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ShopCategory extends Model
{
    //
    protected $fillable = ['name','img','status'];

    public function gclasses(){
        return $this->belongsTo(Gclasses::class);
    }

    public function image(){
        return $this->img ? Storage::url($this->img) : '/image/head.jpg';
    }
}
