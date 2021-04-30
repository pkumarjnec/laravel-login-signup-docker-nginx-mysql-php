<?php
/**
 * Cookies file
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

use Basic\Interfaces\AwsBase;

/**
 * The class to validate input request
 *
 * @category Rules/ Dummy Data
 * @package  Rules/ Dummy Data
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://www.bravechat.com/
 */
class Dummy
{
    /**
     * Create dummy exchange rates
     *
     * @return array
     **/
    static function exchangeRates() : array {
        $rates = array(
            array('from'=>'USD','to'=>'INR','rate'=>75.49),
            array('from'=>'USD','to'=>'CAD','rate'=>1.26),
            array('from'=>'USD','to'=>'CHF','rate'=>0.92),
            array('from'=>'USD','to'=>'EUR','rate'=>0.83),
            array('from'=>'USD','to'=>'GBP','rate'=>0.72),

            array('from'=>'EUR','to'=>'INR','rate'=>90.70),
            array('from'=>'EUR','to'=>'CAD','rate'=>1.51),
            array('from'=>'EUR','to'=>'CHF','rate'=>1.10),
            array('from'=>'EUR','to'=>'USD','rate'=>1.20),
            array('from'=>'EUR','to'=>'GBP','rate'=>0.86),

            array('from'=>'INR','to'=>'USD','rate'=>0.013),
            array('from'=>'INR','to'=>'CAD','rate'=>0.017),
            array('from'=>'INR','to'=>'CHF','rate'=>0.012),
            array('from'=>'INR','to'=>'EUR','rate'=>0.011),
            array('from'=>'INR','to'=>'GBP','rate'=>0.0095),

            array('from'=>'CAD','to'=>'INR','rate'=>59.97),
            array('from'=>'CAD','to'=>'USD','rate'=>0.79),
            array('from'=>'CAD','to'=>'CHF','rate'=>0.73),
            array('from'=>'CAD','to'=>'EUR','rate'=>0.0085),
            array('from'=>'CAD','to'=>'GBP','rate'=>0.57),

            array('from'=>'GBP','to'=>'INR','rate'=>105.15),
            array('from'=>'GBP','to'=>'CAD','rate'=>1.75),
            array('from'=>'GBP','to'=>'CHF','rate'=>1.28),
            array('from'=>'GBP','to'=>'EUR','rate'=>1.16),
            array('from'=>'GBP','to'=>'USD','rate'=>1.39),

            array('from'=>'CHF','to'=>'USD','rate'=>1.10),
            array('from'=>'CHF','to'=>'CAD','rate'=>1.35),
            array('from'=>'CHF','to'=>'INR','rate'=>81.84),
            array('from'=>'CHF','to'=>'EUR','rate'=>0.90),
            array('from'=>'CHF','to'=>'GBP','rate'=>0.79),

        );
        return $rates;
    }
    /**
     * Country and Currency List
     *
     * @return array
     **/
    static function countryCurrency(){
        $countries = array(
           'INR'=>'India',
            'USD'=>'United States',
            'CHF'=>'Swiss Franc',
            'EUR'=>'Europe',
            'GBP'=>'United Kingdom',
            'CAD'=>'Canada'
        );
        return $countries;
    }

}