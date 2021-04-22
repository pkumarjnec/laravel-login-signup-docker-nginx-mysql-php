<?php
/**
 * Cookies file
 *
 * PHP version 7.3
 *
 * @category  Rules
 * @package   Rules
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 The Tech Thing
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      https://www.thetechthing.com/
 */
namespace Basic\Rules;

use Basic\Interfaces\CookiesBase;
use Illuminate\Support\Facades\Cookie;

/**
 * The class holding cookies methods
 *
 * @category Rules
 * @package  Rules
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class Cookies implements CookiesBase
{
    static $rememberTime        = 60*60*24;
    static $key;
    /**
     * Create a new instance
     *
     * @param int $time cookies remember time
     *
     * @return void
     **/
    public function __construct($time=null)
    {
        if ($time != null) {
            self::$rememberTime = $time;
        }
    }
    /**
     * Get internal key name
     *
     * @param string $name cookies key
     *
     * @return string
     **/
    static function encryptKey($key)
    {
        $keys               = array(
            'usernameKey'   => 'cb_t_u_n',
            'passwordKey'   => 'cb_t_u_sk',
        );
        return $keys[$key];
    }
    /**
     * Write Cookies
     *
     * @param string $key   key
     * @param string $value value
     *
     * @return bool
     **/
    public static function write(string $key,string $value): bool
    {
        $key = self::encryptKey($key);
        Cookie::queue(Cookie::make($key, $value, self::$rememberTime));
        return true;
    }
    /**
     * Read Cookies
     *
     * @param string $key key
     *
     * @return bool
     **/
    public static function read(string $key)
    {
        return Cookie::get(self::encryptKey($key));
    }

    /**
     * Destroy Cookies
     *
     * @param string $key key
     *
     * @return bool
     **/
    public static function destroy(string $key): bool
    {
        Cookie::queue(Cookie::forget(self::encryptKey($key)));
        return true;
    }

}