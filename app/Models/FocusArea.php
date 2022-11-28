<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FocusArea extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'funding',
        'capacity_building',
        'data',
        'tech_innovation',
        'podcast',
        'deleted_at'
    ];

    public function users(){
        return $this->hasMany(User::class)->where('status', 1);
    }

    public function Knowledge(){
        return $this->hasMany(Knowledge::class)->where([['knowledge_category_id', 1], ['status', true]]);
    }

    public static function getName($id){
        return self::where('id', $id)->first()->name ?? NULL;
    }

    public static function getFocusAreas($focusAreas){
        $value = explode(',', $focusAreas);// convert to array with explode
        $output = [];
        if(!empty($value)){
            foreach($value as $v) {
                $fa = self::where('id', $v)->first();
                if($fa){
                    $output[] = $fa->name;
                }
            }
        }
        return implode(', ', $output); // covert to comma separated string with
    }
}
