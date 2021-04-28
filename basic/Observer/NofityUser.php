<?php
namespace Basic\Observer;

use \Basic\Rules\Email;

class NofityUser implements \SplObserver
{

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function update(\SplSubject $subject)
    {
        $email = new Email($this->data);
        $email->send();
    }
}

