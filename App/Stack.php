<?php

namespace App;

use App\StackInterface;

/**
 * A stack is a data structure which allows for ordered management of a collection of similar data types.
 * It is defined as a LIFO (last-in first out) data structure so items which have been added last,
 * are removed first from the collection.
 *
 */
class Stack implements StackInterface {

    private $stack = [];

    /**
     * Adding an item on the top of the stack
     *
     * @param int $value
     */
    public function push(int $value): void
    {
        $this->stack[] = $value;
    }

    /**
     * Removes the top-most value from the stack and returns it.
     *
     * @return int
     */
    public function pop(): int
    {
        return array_pop($this->stack);
    }

    /**
     * Returns the top-most value from the stack.
     *
     * @return int
     */
    public function peek(): int
    {
        return end(array_values($this->stack));
    }

    /**
     * Returns count of values from the stack.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->stack);
    }

    /**
     * Returns string representation of the stack
     *
     * @return string
     */
    public function __toString(): string
    {
        return implode(", ", $this->stack);
    }

}
