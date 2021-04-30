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

use App\Mail\Welcome;
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
     * @param $data  array  email data
     *
     * @return void
     **/
    public function __construct(array $data)
    {
        if ($data['type'] == 'welcome') {
            $this->name     = $data['first_name'];
            $this->email    = $data['emailid'];
            $this->emailer  = new Welcome($data);
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