<?php

namespace App;

use App\TransactionableInterface;

/**
 * A transaction is a closed set of changes which are either fully committed or
 * fully rolled back to the affected system.
 *
 */
class Transaction implements TransactionableInterface
{
    private $commands;
    private $uid;

    public function __construct()
    {
        $this->commands = new \SplQueue();
    }

    /**
     * Starts the scope of the transaction
     *
     * @return void
     */
    public function start(): void
    {
        $this->uid = uniqid();
    }

    /**
     * Applies the changes from the current transaction scope
     *
     * @return void
     */
    public function commit(): bool
    {
        while ($this->commands->count() > 0) {
            $command = $this->commands->dequeue();
            $command->execute();
        }
        return true;
    }

    /**
     * Discards the changes from the current transaction scope
     *
     * @return bool
     */
    public function rollback(): bool
    {
        if ($this->commands->count() > 0) {
            $this->commands = new \SplQueue();
        }
        return true;
    }

    /**
     * Return recorded commands in the transaction scope
     *
     * @return \SplQueue
     */
    public function getCommands(): \SplQueue
    {
        return $this->commands;
    }

}
