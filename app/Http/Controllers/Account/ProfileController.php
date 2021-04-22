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
use App\Http\Requests\Account\ProfilePutRequest;
use App\Services\Account\ProfileService;
use Basic\Rules\Security;
use Illuminate\Http\Request;
/**
 * The class holding the login class definition
 *
 * @category Account
 * @package  Account
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class ProfileController extends Controller
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
     * @param ProfileService object $loginService login service object
     *
     * @return void
     **/
    public function __construct(ProfileService $profileService)
    {
        $this->account = $profileService;
    }

    /**
     * Login with user input emailid & password
     *
     * @param Request object $request validated request params
     *
     * @return array
     **/
    public function details(Request $request) : array
    {
        $accountId = $request->get('account_id');
        $response = $this->account->profile($accountId);
        return $response;
    }

    /**
     * Login with user input emailid & password
     *
     * @param ProfilePutRequest object $request validated request params
     *
     * @return array
     **/
    public function update(ProfilePutRequest $request) : array
    {
        $data = Security::filterXss($request->validated());
        $file = $request->file('document');
        $accountId = $request->get('account_id');
        $response = $this->account->update($data,$file,$accountId);
        return $response;
    }
}
