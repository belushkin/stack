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

    /**
     * Adding an item on the top of the stack
     *
     * @return void
     */
    public function execute(): void
    {
        $this->numbers->push($this->numberToPush);
    }

}
