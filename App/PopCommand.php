<?php

namespace App;

class PopCommand
{
    private $numbers;

    public function __construct(\SplStack $numbers)
    {
        $this->numbers = $numbers;
    }

    /**
     * Removes the top-most value from the stack and returns it.
     *
     * @return int|null
     */
    public function execute(): ?int
    {
        if ($this->numbers->count()) {
            return $this->numbers->pop();
        }
        return null;
    }

}
