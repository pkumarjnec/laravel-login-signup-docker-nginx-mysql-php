<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    /**
     * Not Null Id Scope
     *
     * @param $query    object query object
     *
     * @return object
     **/
    public function scopeNotNull($query)
    {
        return $query->whereNotNull('id');
    }
    /**
     * Search Country with Given input parameters
     *
     * @param $data array key value pair to search
     *
     * @return object
     **/
    static function search(array $data) {
        if(empty($data)){
            return new \stdClass();
        }
        $country = Countries::NotNull();
        foreach($data as $key=>$value){
            $country->where($key, $value);
        }
        $country->take(1);
        return $country->first();
    }
    /**
     * Create Country with Given input parameters
     *
     * @param $data array key value pair to create
     *
     * @return object
     **/
    static function create(array $data) : object {
        $country  = new Countries();
        foreach($data as $key=>$value){
            $country->$key = $value;
        }
        $country->save();
        return $country;
    }
    /**
     * Get All Currency along with Country
     *
     * @return object
     **/
    static function countryList() {
        $account = Countries::all();
        return $account;
    }
}
