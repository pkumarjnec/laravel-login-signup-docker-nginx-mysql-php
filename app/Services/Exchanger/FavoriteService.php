<?php
/**
 * FavoriteService Class Doc Comment
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
use App\Model\Favorite;
use Basic\Rules\Cookies;
use Basic\Rules\Dummy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

/**
 * This class hold favorite service
 *
 * @category Exchanger
 * @package  Exchanger
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class FavoriteService
{

    protected $limit=5;
    /**
     * Import Country and Currency List
     *
     * @return array
     */
    public function save($from,$to,$accountId)
    {
        if($from == $to){
            return array('status'=>'error','message'=>Lang::get('account.fav_same'));
        }
        $temp['accounts_id'] = $accountId;
        $count = Favorite::count($temp);
        if ($count >= $this->limit) {
            return array('status'=>'error','message'=>Lang::get('account.fav_limit'));
        }
        $rates = ExchangeRates::search(array('from_currency_id'=>$from,'to_currency_id'=>$to));
        if (!empty($rates)) {
            $temp['exchange_rates_id'] = $rates->id;
            $fav = Favorite::search($temp);
            if (empty($fav)){
                $fav = Favorite::create($temp);
            }
        }
        return array('status'=>'success','message'=>Lang::get('account.fav_created'));
    }

    /**
     * Get My Favorite Exchange Rates
     *
     * @return array
     */
    public function myFavorite($accountId)
    {
        $favRates = array();
        $fav = Favorite::searchAll($accountId);
        if(!empty($fav)){
            $fav = $fav->toArray();
            $cService = new CountryService();
            $countries = $cService->countries();
            foreach($fav as $temp){
                $temp1['from'] = $countries[$temp['rate']['from_currency_id']];
                $temp1['to'] = $countries[$temp['rate']['to_currency_id']];
                $temp1['rate'] = $temp['rate']['rate'];
                $favRates[] = $temp1;
            }
        }
        return $favRates;
    }
}


?>