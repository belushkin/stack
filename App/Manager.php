<?php

namespace App;

class Manager
{
    private $transactions;
    private $numbers;

    public function __construct()
    {
        $this->transactions = new \SplStack();
        $this->numbers = new Stack();
    }

    public function begin()
    {
        $transaction = new Transaction();
        $transaction->start();
        $this->transactions->push($transaction);
    }

    public function rollback()
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

    public function commit()
    {
        if ($this->transactions->count() > 0) {
            $transaction = $this->transactions->pop();
            if ($transaction != null) {
                $transaction->commit();
            }
        }
    }

    public function push(Int $number)
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

    public function top()
    {
        if ($this->numbers->count() > 0) {
            return $this->numbers->peek();
        }
        return 0;
    }

    public function pop()
    {
        if ($this->transactions->count() > 0) {
            $transaction = $this->transactions->top();
            if ($transaction != null) {
                $popCommand = new PopCommand($this->numbers);
                $transaction->getCommands()->enqueue($popCommand);
            }
        } else {
            if ($this->numbers->count() > 0) {
                $this->numbers->pop();
            }
        }
    }

}
