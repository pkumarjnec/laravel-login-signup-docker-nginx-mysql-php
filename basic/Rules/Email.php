<?php
/**
 * Email file
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

use Basic\Interfaces\EmailBase;
use Illuminate\Support\Facades\Mail;

/**
 * The class holding Outgoing Email Methods
 *
 * @category Rules
 * @package  Rules
 * @author   Pankaj <pkjnec@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     https://www.thetechthing.com/
 */
class Email implements EmailBase
{
    protected $emailer;
    protected $email;
    protected $name;

    /**
     * Create a new Email instance
     *
     * @param $email string emailid
     * @param $name  string name
     * @param $data  array  email data
     *
     * @return void
     **/
    public function __construct(string $email, string $name, array $data)
    {
        $this->name     = $name;
        $this->email    = $email;
        if ($data['type'] == 'verify') {
            $this->emailer = new VerifyToken($data['code'], $data['first_name']);
        } else if ($data['type'] == 'forgot') {
            $this->emailer = new VerifyToken($data['code'], $data['first_name']);
        }
    }

    /**
     * Send email
     *
     * @return bool
     **/
    public function send(): bool
    {
        Mail::to([['email'=>$this->email,'name'=>$this->name]])
            ->queue($this->emailer);
        //Log Mail Details
        return true;
    }

    /**
     * Save email log
     *
     * @return bool
     **/
    public function log() : bool
    {
        /*
         * @TODO
         * Write Log for Emails
         */
        return false;
    }

}