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
 * @link      https://www.thetechthing.com/
 */
namespace Basic\Rules;

/**
 * The class to validate input request
 *
 * @category Rules
 * @package  Rules
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class Security
{
    /**
     * Validate user input
     *
     * @param $request array|string user input
     *
     * @return array
     **/
    static function filterXss($request) : array
    {
        if (empty($request) || $request == '') {
            return null;
        }
        $skips       = array('returnUrl');
        if (!is_array($request)) {
            return trim(self::cleanXss($request));
        } else {
            $tempRequest = array();
            foreach ($request as $key=>$value) {
                if (!in_array($key, $skips)) {
                    if (is_array($value)) {
                        $temp2   = array();
                        foreach ($value as $key2=>$value2) {
                            if (is_array($value2)) {
                                $temp3   = array();
                                foreach ($value2 as $key3=>$value3) {
                                    $temp3[$key3]  = trim(self::cleanXss($value3));
                                }
                                $temp2[$key2] = $temp3;
                            } else {
                                $temp2[$key2]  = trim(self::cleanXss($value2));
                            }
                        }
                        $tempRequest[$key] = $temp2;
                    } else {
                        $tempRequest[$key] = trim(self::cleanXss($value));
                    }
                } else {
                    if (is_array($value)) {
                        $temp2   = array();
                        foreach ($value as $key2=>$value2) {
                            $temp2[$key2]  = trim($value2);
                        }
                        $tempRequest[$key] = $temp2;
                    } else {
                        $tempRequest[$key] = trim($value);
                    }
                }
            }
        }
        return $tempRequest;
    }

    /**
     * Validate XSS user input
     *
     * @param $data string user input
     *
     * @return string
     **/
    static function cleanXss(string $data) : string
    {
        $data = str_replace(
            array('&amp;','&lt;','&gt;','=','&nbsp;'),
            array('&amp;amp;','&amp;lt;','&amp;gt;','',' '),
            $data
        );
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace(
            '#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>',
            $data
        );
        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data       = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        } while ($old_data !== $data);
        return $data;
    }
}