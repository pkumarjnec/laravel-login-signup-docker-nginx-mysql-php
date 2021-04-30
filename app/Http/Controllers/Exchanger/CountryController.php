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
use App\Services\Exchanger\CountryService;
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
class CountryController extends Controller
{
    /**
     * Assign country service object
     *
     * @var object
     **/
    protected $service;
    /**
     * Create a new login service instance
     *
     * @param CountryService object $loginService login service object
     *
     * @return void
     **/
    public function __construct(CountryService $countryService)
    {
        $this->service = $countryService;
    }

    /**
     * Login with user input emailid & password
     *
     * @param Request object $request validated request params
     *
     * @return array
     **/
    public function countries(Request $request) : array
    {
        $response       = $this->service->countries();
        return array('status'=>'success','countries'=>$response);
    }

    /**
     * Login with user input emailid & password
     *
     * @param Request object $request validated request params
     *
     * @return array
     **/
    public function import() : array
    {
        $this->service->import();
        return array('status'=>'success');
    }
}
