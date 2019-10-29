<?php

namespace App;

class PopCommand
{
    private $numbers;

    public function __construct(Stack $numbers)
    {
        $this->numbers = $numbers;
    }

    public function execute(): bool
    {
        if ($this->numbers->count()) {
            $this->numbers->pop();
            return true;
        }
        return false;
    }

}
