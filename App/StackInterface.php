<?php

namespace App;

interface StackInterface
{
    /**
     * Pushes an integer value on top of the stack
     *
     * @param int $value
     */
    public function push(int $value): void;

    /**
     * Removes the top-most value from the stack and returns it.
     *
     * @return int
     */
    public function pop(): int;

    /**
     * Returns the top-most value from the stack.
     *
     * @return int
     */
    public function peek(): int;
}
