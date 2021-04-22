<?php
/**
 * LoginController Class file
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
use App\Http\Requests\Account\LoginPostRequest;
use App\Services\Account\LoginService;
use Basic\Rules\Security;

/**
 * The class holding the login class definition
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling login request for any
    | user that recently registered with the application. Login is validating
    | using email & password
    |
    */
    /**
     * Assign login service object
     *
     * @var object
     **/
    protected $account;
    /**
     * Create a new login service instance
     *
     * @param LoginService object $loginService login service object
     *
     * @return void
     **/
    public function __construct(LoginService $loginService)
    {
        $this->account = $loginService;
    }

    /**
     * Login with user input emailid & password
     *
     * @param LoginPostRequest object $request validated request params
     *
     * @return array
     **/
    public function login(LoginPostRequest $request) : array
    {
        $data           = Security::filterXss($request->validated());
        $response       = $this->account->login($data);
        if ($response['status'] == 'success') {
            $response['redirectUrl'] = '/dashboard';
        }
        return $response;
    }
}
