<?php
/**
 * CURL Request file
 *
 * PHP version 7.3
 *
 * @category  Rules
 * @package   Rules
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 The Tech Thing
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link     https://www.thetechthing.com/
 */
namespace Basic\Rules;

/**
 * The class to do CURL request
 *
 * @category Rules
 * @package  Rules
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://www.bravechat.com/
 */
class Curl
{
    /**
     * Validate user input
     *
     * @param $request array|string user input
     *
     * @return array
     **/
    static function curlRequest($url,$param=NULL,$time=NULL){
        if($time == NULL){
            $time           = 6;
        }
        $ch 				= curl_init($url) ;
        curl_setopt($ch, CURLOPT_HEADER,false);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_TIMEOUT, $time);
        if($param != NULL){
            curl_setopt($ch,CURLOPT_POSTFIELDS, $param);
        }
        $response 			= curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}