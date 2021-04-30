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
class CountryService
{

    /**
     * Import Country and Currency List
     *
     * @return void
     */
    public function import()
    {
        $countries = Dummy::countryCurrency();
        foreach($countries as $key=>$value){
            $country = Countries::search(array('currency'=>$key));
            if(empty($country)){
                $temp['name'] = $value;
                $temp['currency'] = $key;
                Countries::create($temp);
            }
        }
    }

    /**
     * Get Country List with Id
     *
     * @return array
     */
    public function countries() : array
    {
        $data = Countries::countryList();
        $countries = [];
        if(!empty($data)){
            $data = $data->toArray();
            foreach($data as $country){
                $countries[$country['id']] = $country['name'];
            }
        }
        return $countries;
    }

    /**
     * Get Currency List with Id
     *
     * @return array
     */
    public function currencies() : array
    {
        $data = Countries::countryList();
        $currencies = [];
        if(!empty($data)){
            $data = $data->toArray();
            foreach($data as $country){
                $currencies[$country['currency']] = $country['id'];
            }
        }
        return $currencies;
    }
}


?>