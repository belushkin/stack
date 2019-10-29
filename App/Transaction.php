<?php

namespace App;

use App\TransactionableInterface;

class Transaction implements TransactionableInterface
{
    private $commands;
    private $uid;

    public function __construct()
    {
        $this->commands = new \SplQueue();
    }

    public function start(): void
    {
        $this->uid = uniqid();
    }

    public function commit(): bool
    {
        while ($this->commands->count() > 0) {
            $command = $this->commands->dequeue();
            $command->execute();
        }
        return true;
    }

    public function rollback(): bool
    {
        if ($this->commands->count() > 0) {
            $this->commands = new \SplQueue();
            return true;
        }
        return false;
    }

    public function getCommands()
    {
        return $this->commands;
    }

}
