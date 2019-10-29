<?php

namespace App;

use App\StackInterface;

class Stack implements StackInterface {

    private $stack = [];

    public function push(int $value): void
    {
        $this->stack[] = $value;
    }

    public function pop(): int
    {
        return array_pop($this->stack);
    }

    public function peek(): int
    {
        return end(array_values($this->stack));
    }

    public function count()
    {
        return count($this->stack);
    }

}
