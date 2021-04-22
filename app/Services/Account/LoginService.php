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
class LoginService
{

    /**
     * Login using email & password
     *
     * @param $input array email & password
     *
     * @return array
     */
    public function login(array $input) : array
    {
        //If Request is empty the return error
        if (empty($input) || $input['emailid'] == '' || $input['password'] == '') {
            $message = array('status'=>'error',
                'message'=>Lang::get('account.empty_request'),'code'=>422);
            return $message;
        }
        //Check for Login using emailid & password
        $account = Account::login($input['emailid'], $input['password']);
        if (!empty($account)) {
            //If found Load Data into Auth & Store emailid in Cookies
            $this->doLogin($input, $account);
            $message = array('status'=>'success',
                'message'=>Lang::get('account.successful_login'),
                'token'=>$account->access_token,'code'=>200);
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
     * @param $input   array user input
     * @param $account object account
     *
     * @return void
     */
    private function doLogin(array $input, object $account)
    {
        Auth::login($account, true);
        Cookies::write('usernameKey', $input['emailid']);
    }


}


?>