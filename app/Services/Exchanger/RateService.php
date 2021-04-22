<?php
/**
 * CountryService Class Doc Comment
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
namespace App\Services\Exchanger;

use App\Model\Account;
use App\Model\Countries;
use App\Model\ExchangeRates;
use Basic\Rules\Cookies;
use Basic\Rules\Dummy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * This class hold country & currency service
 *
 * @category Exchanger
 * @package  Exchanger
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class RateService
{

    /**
     * Import Country and Currency List
     *
     * @return void
     */
    public function import($data)
    {
        $countryService = new CountryService();
        $currencies = $countryService->currencies();
        foreach($data as $rate){
            $rates = ExchangeRates::search(array('from_currency_id'=>$currencies[$rate['from']],'to_currency_id'=>$currencies[$rate['to']]));
            $temp = array();
            if(empty($rates)){
                $temp['from_currency_id'] = $currencies[$rate['from']];
                $temp['to_currency_id'] = $currencies[$rate['to']];
                $temp['rate'] = $rate['rate'];
                ExchangeRates::create($temp);
            }else {
                $temp['id'] = $rates->id;
                $temp['rate'] = $rate['rate'];
                ExchangeRates::modify($temp);
            }
        }
    }

    /**
     * Login, Load Auth & Register Login Time
     *
     * @return float
     */
    public function search($from,$to)
    {
        if($from == $to){
            return 1;
        }
        $rate = ExchangeRates::search(array('from_currency_id'=>$from,'to_currency_id'=>$to));
        if(!empty($rate)){
            return $rate->rate;
        }
        return 0;
    }
}


?>