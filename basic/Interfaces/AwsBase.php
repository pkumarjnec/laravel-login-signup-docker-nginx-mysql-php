<?php
/**
 * AWS Interface file
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
 * The interface holding AWS methods
 *
 * @category Interface
 * @package  Interface
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
interface AwsBase
{

    /**
     * Upload File to AWS
     *
     * @param array $files     file details
     * @param int   $accountId user account id
     *
     * @return string
     **/
    public static function upload(array $files): string;
    /**
     * Download File from AWS
     *
     * @param string $url file url
     *
     * @return string
     **/
    public static function download(string $url) : string ;
};