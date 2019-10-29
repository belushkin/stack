<?php

namespace App;

class PushCommand
{
    private $numberToPush;
    private $numbers;

    public function __construct(Int $numberToPush, Stack $numbers)
    {
        $this->numberToPush = $numberToPush;
        $this->numbers = $numbers;
    }

    public function execute(): bool
    {
        $this->numbers->push($this->numberToPush);
        return true;
    }

}
