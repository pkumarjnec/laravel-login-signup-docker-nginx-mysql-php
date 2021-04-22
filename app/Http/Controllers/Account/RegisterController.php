<?php
/**
 * RegisterController Class file
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
namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\RegisterPostRequest;
use App\Services\Account\RegisterService;
use Basic\Rules\Security;

/**
 * The class holding the register class definition
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling registration request for any
    | user who want to register.
    |
    */
    /**
     * Assign register service object
     *
     * @var object
     **/
    protected $account;
    /**
     * Create a new login service instance
     *
     * @param RegisterService object $registerService signup service object
     *
     * @return void
     **/
    public function __construct(RegisterService $registerService)
    {
        $this->account = $registerService;
    }

    /**
     * Account signup using emailid & password and send verification code in
     * email for email validation
     *
     * @param RegisterPostRequest object $request validated request params
     *
     * @return array $account
     **/
    public function register(RegisterPostRequest $request) : array
    {
        $data               = Security::filterXss($request->validated());
        $file               = $request->file('document');
        $response           = $this->account->register($data,$file);
        if ($response['status'] == 'success') {
            $response['redirectUrl'] = '/login';
        }
        return $response;
    }
}
