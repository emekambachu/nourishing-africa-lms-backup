<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public static function getName($id){
        return self::where('id', $id)->first()->name ?? "";
    }

    public static function getCountries($countries){
        $value = explode(', ', $countries);//convert to array with explode
        $output = [];
        foreach($value as $v) {
            $getCountry = self::where('id', $v)->first();
            if($getCountry){
                $output[] = $getCountry->name;
            }
        }
        return implode(', ', $output); // covert to comma separated string with
    }
}
