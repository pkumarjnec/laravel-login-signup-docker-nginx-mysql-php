<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExchangeRates extends Model
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
     * Search Exchange Rate
     *
     * @param $data array key value pair to search
     *
     * @return object
     **/
    static function search(array $data) {
        if(empty($data)){
            return false;
        }
        $rate = ExchangeRates::NotNull();
        foreach($data as $key=>$value){
            $rate->where($key, $value);
        }
        $rate->take(1);
        return $rate->first();
    }
    /**
     * Create Exchange Rate
     *
     * @param $data array key value pair to create
     *
     * @return object
     **/
    static function create(array $data) : object {
        $rate  = new ExchangeRates();
        foreach($data as $key=>$value){
            $rate->$key = $value;
        }
        $rate->save();
        return $rate;
    }

    /**
     * Update Account with Given input parameters
     *
     * @param $data array key value pair to create
     *
     * @return object
     **/
    static function modify(array $data) : object {
        $rate = ExchangeRates::search(array('id'=>$data['id']));
        if(!empty($rate)){
            foreach($data as $key=>$value){
                $rate->$key = $value;
            }
            $rate->save();
            return $rate;
        }
        return false;
    }
}
