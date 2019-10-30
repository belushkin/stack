<?php

namespace App;

use App\StackInterface;
use App\TransactionableInterface;

class Stack implements StackInterface, TransactionableInterface
{
    private $transactions;
    private $numbers;

    public function __construct()
    {
        $this->transactions = new \SplStack();
        $this->numbers = new \SplStack();
    }

    /**
     * Starts the scope of the transaction
     *
     * @return void
     */
    public function start(): void
    {
        $transaction = new Transaction();
        $transaction->start();
        $this->transactions->push($transaction);
    }

    /**
     * Discards the changes from the current transaction scope
     *
     * @return bool
     */
    public function rollback(): bool
    {
        if ($this->transactions->count() > 0) {
            $transaction = $this->transactions->pop();
            if ($transaction != null) {
                return true;
            }
            return false;
        }
        return false;
    }

    /**
     * Applies the changes from the current transaction scope
     *
     * @return bool
     */
    public function commit(): bool
    {
        if ($this->transactions->count() > 0) {
            $transaction = $this->transactions->pop();
            if ($transaction != null) {
                return $transaction->commit();
            }
        }
        return true;
    }

    /**
     * Adding an item on the top of the stack
     *
     * @param Int $number
     * @return void
     */
    public function push(Int $number): void
    {
        if ($this->transactions->count() > 0) {
            $transaction = $this->transactions->top();
            if ($transaction != null) {
                $pushCommand = new PushCommand($number, $this->numbers);
                $transaction->getCommands()->enqueue($pushCommand);
            }
        } else {
            $this->numbers->push($number);
        }
    }

    /**
     * Returns the actual stack of numbers
     *
     * @return array
     */
    public function top(): array
    {
        $result = [];
        $this->numbers->rewind();

        while($this->numbers->valid()) {
            $result[] = $this->numbers->current();
            $this->numbers->next();
        }
        return $result;
    }

    /**
     * Returns the actual stack of numbers
     *
     * @return int
     */
    public function peek(): int
    {
        if ($this->numbers->count() > 0) {
            return $this->numbers->top();
        }
        return 0;
    }

    /**
     * Removes the top-most value from the stack and returns it.
     *
     * @return int|null
     */
    public function pop(): int
    {
        if ($this->transactions->count() > 0) {
            $transaction = $this->transactions->top();
            if ($transaction != null) {
                $popCommand = new PopCommand($this->numbers);
                return $transaction->getCommands()->enqueue($popCommand);
            }
        } else {
            if ($this->numbers->count() > 0) {
                return $this->numbers->pop();
            }
        }
        return 0;
    }

}
