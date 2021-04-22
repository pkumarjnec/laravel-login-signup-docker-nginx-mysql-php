<?php
/**
 * LoginService Class Doc Comment
 *
 * PHP version 7.2
 *
 * @category  Account
 * @package   Account
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 The Tech Thing
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      https://www.thetechthing.com/
 */
namespace App\Services\Account;

use App\Model\Account;
use Basic\Rules\Aws;
use Basic\Rules\Cookies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * This class hold login service
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class ProfileService
{

    /**
     * Login using email & password
     *
     * @param $accountId int email & password
     *
     * @return array
     */
    public function profile(int $accountId) : array
    {
        //If Request is empty the return error
        if ($accountId == '') {
            $message = array('status'=>'error',
                'message'=>Lang::get('account.empty_request'),'code'=>422);
            return $message;
        }
        //Check for Login using emailid & password
        $account = Account::search(array('id'=>$accountId));
        if (!empty($account)) {
            //If found Load Data into Auth & Store emailid in Cookies
            $message = array('status'=>'success',
                'token'=>$account->access_token,'code'=>200,'account'=>$account);
            return $message;
        } else {
            //Return error message
            $message = array('status'=>'error',
                'message'=>Lang::get('account.invalid_login'),'code'=>200);
            return $message;
        }
    }

    /**
     * Login, Load Auth & Register Login Time
     *
     * @param $data      array user input
     * @param $account   object account
     * @param $accountId int $accountId
     *
     * @return array
     */
    public function update(array $data,$file,int $accountId)
    {
        if ($accountId == '' || empty($data)) {
            $message = array('status'=>'error',
                'message'=>Lang::get('account.empty_request'),'code'=>422);
            return $message;
        }
        $account = Account::search(array('id'=>$accountId));
        if(empty($account)){
            $message = array('status'=>'error',
                'message'=>Lang::get('account.not_exist'),'code'=>200);
            return $message;
        }
        if($account->emailid != strtolower(trim($data['emailid']))){
            $account = Account::search(array('emailid'=>strtolower(trim($data['emailid']))));
            if(!empty($account)){
                $message = array('status'=>'error',
                    'message'=>Lang::get('account.already_exist'),'code'=>200);
                return $message;
            }
        }
        $data['id'] = $accountId;
        if (isset($data['name']) && $data['name'] != '') {
            $tName = explode(' ', $data['name']);
            $data['first_name'] = $tName[0];
            $data['last_name'] = $tName[1];
        }
        if(count((array)$file)){
            $data['document'] = Aws::upload($file);
        }
        $account = Account::modify($data);
        //Send Password in email
        $message = array('status'=>'success',
            'message'=>Lang::get('account.updated'), 'code'=>200);
        return $message;
    }


}


?>