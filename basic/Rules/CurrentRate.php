<?php
/**
 * Current Rate Exchanger file
 *
 * PHP version 7.2
 *
 * @category  Rules
 * @package   Rules
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 Braviara Technologies LLP (ABN 77 084 670 600)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      http://www.bravechat.com/
 */
namespace Basic\Rules;

use App\Services\Exchanger\RateService;
use Basic\Interfaces\ExchangeBase;

/**
 * The class to validate input request
 *
 * @category Rules
 * @package  Rules
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://www.bravechat.com/
 */
class CurrentRate implements ExchangeBase
{
    protected $rates;

    /**
     * Create a new CurrentRate instance
     *
     * @return void
     **/
    public function __construct()
    {
        $this->rates = self::fetchRate();
    }

    /**
     * Fetch Rates from Exchange
     *
     * @return array
     **/
    static function fetchRate() : array {
        //@TODO : Fetch Current Curreny Rate from External API
        //Passing Dummy Data for now
        return Dummy::exchangeRates();
    }

    /**
     * Save exchange rates into the database
     *
     * @return void
     **/
    public function saveRate() : void {
        //Save Rates to Database
        $rateService = new RateService();
        $rateService->import($this->rates);
    }

}