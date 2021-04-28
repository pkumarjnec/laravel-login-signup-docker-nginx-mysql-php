<?php
namespace Basic\Observer;

class RegistrationObserver implements \SplSubject
{
    protected $queue = [];

    /**
     * Add an observer method
     *
     * @param \SplObserver $observer
     *
     * @return RegistrationObserver
     */
    public function attach(\SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        $this->queue[$key] = $observer;
        return $this;
    }

    /**
     * Remove an observer
     *
     * @param \SplObserver $observer
     */
    public function detach(\SplObserver $observer)
    {
        $key = spl_object_hash($observer);
        unset($this->queue[$key]);
    }

    /**
     * Iterate over all observers and call observer update method
     */
    public function notify()
    {
        foreach ($this->queue as $observer) {
            $observer->update($this);
        }
    }
}

