<?php
/**
 * RegisterService Class Doc Comment
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
namespace App\Services\Account;

use App\Model\Account;
use Basic\Observer\NofityUser;
use Basic\Rules\Aws;
use Basic\Rules\Email;
use Basic\Observer\NotifyUser;
use Basic\Observer\RegistrationObserver;
use Illuminate\Support\Facades\Lang;

/**
 * This class hold account signup service
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class RegisterService
{

    /**
     * Register using emailid & password
     *
     * @param array  $data email & password
     * @param object $file document
     *
     * @return array
     */
    public function register(array $data, object $file) : array
    {
        //If Request is empty the return error
        if (empty($data)) {
            $message = array('status'=>'error',
                'message'=>Lang::get('account.empty_request'), 'code'=>422);
            return $message;
        } else if (count((array)$file) == 0) {
            $message = array('status'=>'error',
                'message'=>Lang::get('account.empty_request'), 'code'=>422);
            return $message;
        }
        //Check if Account already exist using email id
        $account = Account::search(array('emailid'=>$data['emailid']));
        if (!empty($account)) {
            //If Account already exist return error
            $message = array('status'=>'error',
                'message'=>Lang::get('account.already_exist'), 'code'=>200);
            return $message;
        } else if($data['mobile_no'] != ''){
            //Check if Account already exist using email id
            $account = Account::search(array('mobile_no'=>$data['mobile_no']));
            if (!empty($account)) {
                //If Account already exist return error
                $message = array('status'=>'error',
                    'message'=>Lang::get('account.mobile_exist'), 'code'=>200);
                return $message;
            }
        }

        //Register with input details
        if (isset($data['name']) && $data['name'] != '') {
            $tName = explode(' ', $data['name']);
            $data['first_name'] = $tName[0];
            $data['last_name'] = $tName[1];
        }

        //Created Dummy logic to generate random Password
        $password = rand(1000000,200000000);
        $data['password'] = md5($password);
        $data['document'] = Aws::upload($file);
        $account = Account::create($data);

        //Send Password in email
        $data['password'] = $password;
        $data['type'] = 'welcome';

        //Registration Observer trigger Email Sending
        $userRegistered = new RegistrationObserver();
        $userRegistered->attach(new NofityUser($data));
        $userRegistered->notify();

        //Normal Email Sending
        //$email = new Email($account->emailid, $account->first_name, $data);
        //$email->send();

        //Return Message
        $message = array('status'=>'success',
            'message'=>Lang::get('account.created'), 'code'=>200);
        return $message;
    }

}


?>