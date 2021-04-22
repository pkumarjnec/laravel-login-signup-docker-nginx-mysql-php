<?php
/**
 * Cookies file
 *
 * PHP version 7.3
 *
 * @category  Interface
 * @package   Interface
 * @author    Pankaj <pkjnec@gmail.com>
 * @copyright 2021 The Tech Thing
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version   GIT: <git_id>
 * @link      https://www.thetechthing.com/
 */
namespace Basic\Interfaces;

/**
 * The interface holding Cookies Methods
 *
 * @category Interface
 * @package  Interface
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
interface CookiesBase
{

    /**
     * Write Cookies
     *
     * @param string $key   key
     * @param string $value value
     *
     * @return bool
     **/
    public static function write(string $key,string $value): bool;
    /**
     * Read Cookies
     *
     * @param string $key key
     *
     * @return bool
     **/
    public static function read(string $key);
    /**
     * Destroy Cookies
     *
     * @param string $key key
     *
     * @return bool
     **/
    public static function destroy(string $key): bool;
};