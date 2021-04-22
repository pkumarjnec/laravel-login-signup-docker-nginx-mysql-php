<?php
/**
 * Email Interface file
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
 * The interface holding Outgoing Email Methods
 *
 * @category Interface
 * @package  Interface
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
interface EmailBase
{
    /**
     * Send email
     *
     * @return bool
     **/
    public function send(): bool;
    /**
     * Save email log
     *
     * @return bool
     **/
    public function log(): bool;
};