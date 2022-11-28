<?php

namespace App\Models;

use App\Models\InternMatchMaking\InternInstitution;
use App\Models\InternMatchMaking\InternProfile;
use Illuminate\Database\Eloquent\Model;

class AllCountries extends Model
{
    protected $table = 'all_countries';

    protected $fillable = [
        'phone_code',
        'country_code',
        'country_name',
        'continent_code',
        'continent_name'
    ];

    public static function africanCountries(){
        return self::where('continent_name', '=', 'Africa')->orderby('country_name')->get();
    }

    public static function getName($id){
        return self::where('id', $id)->first()->country_name;
    }

    public function internInstitutions(){
        return $this->hasMany(InternInstitution::class, 'country_id', 'id');
    }

    public function internProfiles(){
        return $this->hasMany(InternProfile::class, 'country_id', 'id');
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
