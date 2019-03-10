<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Navs extends Model
{
    //
    protected $fillable = ['name','url','permission_id','pid'];

    public static function navData(){
        $p=self::select('name','pid','url','id','permission_id')->where('pid',0)->get();

        return $p;
    }

    public static function navDataz(){
        $z=self::select('name','pid','url')->where('pid','!=',0)->get();

        return $z;
    }

}
