<?php
/**
 * CountryController Class file
 *
 * PHP version 7.3
 *
 * @category  Exchanger
 * @package   Exchanger
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 The Tech Thing
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      https://www.thetechthing.com/
 */
namespace App\Http\Controllers\Exchanger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FavoritePostRequest;
use App\Services\Exchanger\CountryService;
use App\Services\Exchanger\FavoriteService;
use Illuminate\Http\Request;
/**
 * The class holding the login class definition
 *
 * @category Exchanger
 * @package  Exchanger
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class FavoriteController extends Controller
{
    /**
     * Assign country service object
     *
     * @var object
     **/
    protected $service;
    /**
     * Assign country service object
     *
     * @var object
     **/
    protected $countryService;
    /**
     * Create a new login service instance
     *
     * @param FavoriteService object $loginService login service object
     *
     * @return void
     **/
    public function __construct(FavoriteService $favoriteService, CountryService $countryService)
    {
        $this->service = $favoriteService;
        $this->countryService = $countryService;
    }

    /**
     * Login with user input emailid & password
     *
     * @param Request object $request validated request params
     *
     * @return array
     **/
    public function search(Request $request) : array
    {
        $accountId = $request->get('account_id');
        $response = $this->service->myFavorite($accountId);
        return array('status'=>'success','rate'=>$response,'total'=>count($response));
    }
    /**
     * Login with user input emailid & password
     *
     * @param Request object $request validated request params
     *
     * @return array
     **/
    public function save(FavoritePostRequest $request) : array
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $accountId = $request->get('account_id');
        $response = $this->service->save($from,$to,$accountId);
        return $response;
    }
}
