<?php
/**
 * Account Model Class file
 *
 * PHP version 7.3
 *
 * @category  Account
 * @package   Account
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 The Tech Thing
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      https://www.thetechthing.com/
 */
namespace App\Model;


use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * The class holding Account db functions
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class Account extends Authenticatable

{
    protected $hidden = ['password','created_at','updated_at'];
    /**
     * Login Scope
     *
     * @param $query    object query object
     * @param $emailid  string emailid
     * @param $password string password
     *
     * @return object
     **/
    public function scopeSecureLogin($query,string $emailid, string $password)
    {
        return $query->where('emailid', $emailid)->where('password',md5($password));
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
     * Login with user input emailid & password
     *
     * @param $emailid  string emailid
     * @param $password string password
     *
     * @return object
     **/
    static function login(string $emailid,string $password) {
        $account    = Account::SecureLogin($emailid,$password);
        $account->take(1);
        return $account->first();
    }

    /**
     * Search Account with Given input parameters
     *
     * @param $data array key value pair to search
     *
     * @return object
     **/
    static function search(array $data) {
        if(empty($data)){
            return false;
        }
        $account = Account::NotNull();
        foreach($data as $key=>$value){
            $account->where($key, $value);
        }
        $account->take(1);
        return $account->first();
    }

    /**
     * Create Account with Given input parameters
     *
     * @param $data array key value pair to create
     *
     * @return object
     **/
    static function create(array $data) : object {
        $account = new Account();
        $account->status = 'active';
        $account->access_token = md5($data['emailid'].rand(1, 100000));
        foreach($data as $key=>$value){
            $account->$key = $value;
        }
        $account = self::decorate($account);
        $account->save();
        return $account;
    }

    /**
     * Update Account with Given input parameters
     *
     * @param $data array key value pair to create
     *
     * @return object
     **/
    static function modify(array $data) : object {
        $account = Account::search(array('id'=>$data['id']));
        if(!empty($account)){
            foreach($data as $key=>$value){
                $account->$key = $value;
            }
            $account = self::decorate($account);
            $account->save();
            return $account;
        }
        return false;
    }

    /**
     * Format Account Details
     *
     * @param $account object key value pair to format
     *
     * @return object
     **/
    static function decorate(object $account) : object {
        if($account->name == '' && $account->last_name != ''){
            $account->name = $account->first_name.' '.$account->last_name;
        }
        $account->first_name = ucwords(strtolower($account->first_name));
        $account->last_name = ucwords(strtolower($account->last_name));
        $account->name = ucwords(strtolower($account->name));
        $account->emailid = strtolower($account->emailid);
        return $account;
    }
}
