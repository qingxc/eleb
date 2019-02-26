<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Menus extends Model
{
    //
    protected $fillable = ['goods_name','rating','shop_id','category_id','goods_price','description',
        'month_sales','rating_count','tips','satisfy_count','satisfy_rate','goods_img','status'];

    public function image(){
        return $this->img ? Storage::url($this->img) : '/image/head.jpg';
    }
}
