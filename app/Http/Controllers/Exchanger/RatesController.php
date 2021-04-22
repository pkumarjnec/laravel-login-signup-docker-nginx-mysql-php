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
use App\Http\Requests\Api\RateGetRequest;
use App\Services\Exchanger\CountryService;
use App\Services\Exchanger\RateService;
use Basic\Rules\CurrentRate;
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
class RatesController extends Controller
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
     * @param RateService object $loginService login service object
     *
     * @return void
     **/
    public function __construct(RateService $rateService, CountryService $countryService)
    {
        $this->service = $rateService;
        $this->countryService = $countryService;
    }

    /**
     * Login with user input emailid & password
     *
     * @param Request object $request validated request params
     *
     * @return array
     **/
    public function search(RateGetRequest $request) : array
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $response       = $this->service->search($from,$to);
        return array('status'=>'success','rate'=>$response);
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
        $currentRate = new CurrentRate();
        $currentRate->saveRate();
        return array('status'=>'success');
    }
}
