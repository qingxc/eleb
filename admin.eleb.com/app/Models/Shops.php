<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Shops extends Model
{
    //
    protected $fillable = ['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao',
        'bao','piao','zhun','start_send','send_cost','notice','discount','status'];

    public function gclasses(){
        return $this->belongsTo(Gclasses::class);
    }

    public function image(){
        return $this->shop_img ? Storage::url($this->shop_img) : '/image/head.jpg';
    }
}
