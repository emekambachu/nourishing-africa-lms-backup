<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CountryNew extends Model{

    protected $fillable = [
        'name',
        'alpha_code2',
        'alpha_code3',
        'call_code',
        'group_tag',
        'parent_id',
        'type'
    ];

    protected $table = 'countries_new';

    public static function getCountryName($id){
        return self::where('id', $id)->first()->name;
    }

    public function parent(){
        return $this->belongsTo(__CLASS__, "parent_id");
    }

    public function sub(){
        return $this->hasMany(__CLASS__, "parent_id", "id");
    }

    public function entrepreneurs(){
        return $this->hasMany(User::class, "country_id", "id")
            ->where('users.status', '=', 1)
            ->where('users.is_expert', '=', 0)
            ->where('users.user_type', '=', null);
    }
    public function articles(){
        return $this->hasMany(Article::class, "country_id", "id")
            ->where('articles.status', '=', 1);
    }

    public static function getAfricanCountries($all = false){
        $build = self::where('group_tag', 'REGEXP', DB::raw("'^2-([0-9]+)-([0-9]+)$'"));
        if ($all) {
            $build = $build->orWhere("group_tag", "2");
        }
        return $build->orderBy('name')->get();
    }

    public static function getAfricanRegions($all = false){
        $build = self::where('group_tag', 'REGEXP', DB::raw("'^2-([0-9]+)$'"));
        if ($all) {
            $build = $build->orWhere("group_tag", "2");
        }
        return $build->orderBy('name')->get();
    }

    public static function getAfricanCountry($all = false){
        return self::where('continent', 'africa')->orderBy('name')->get();
    }

    public static function getCountries($countries){
        $value = explode(',', $countries);//convert to array with explode
        $output = [];
        foreach($value as $v) {
            $output[] = self::where('id', $v)->first()->name;
        }
        return implode(', ', $output); // covert to comma separated string with
    }
}
