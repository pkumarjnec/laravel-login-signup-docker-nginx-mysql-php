<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * Relation with Exchange Rate
     *
     * @return object
     **/
    public function rate() {
        return $this->hasOne('App\Model\ExchangeRates','id','exchange_rates_id');
    }
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
            return false;
        }
        $fav = Favorite::NotNull();
        foreach($data as $key=>$value){
            $fav->where($key, $value);
        }
        $fav->take(1);
        return $fav->first();
    }
    /**
     * Create Country with Given input parameters
     *
     * @param $data array key value pair to create
     *
     * @return object
     **/
    static function create(array $data) : object {
        $fav  = new Favorite();
        foreach($data as $key=>$value){
            $fav->$key = $value;
        }
        $fav->save();
        return $fav;
    }
    /**
     * Search Country with Given input parameters
     *
     * @param $data array key value pair to search
     *
     * @return object
     **/
    static function count(array $data) {
        if(empty($data)){
            return false;
        }
        $fav = Favorite::NotNull();
        foreach($data as $key=>$value){
            $fav->where($key, $value);
        }
        return $fav->count();
    }
    /**
     * Search Country with Given input parameters
     *
     * @param $accountId int key value pair to search
     *
     * @return object
     **/
    static function searchAll(int $accountId) {
        if($accountId == ''){
            return false;
        }
        $fav = Favorite::where('accounts_id',$accountId)->with('rate')->get();
        return $fav;
    }

}
