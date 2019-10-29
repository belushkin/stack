<?php

namespace App;

interface TransactionableInterface
{
    /**
     * Begins a transaction scope
     */
    public function start(): void;

    /**
     * Ends a transaction scope and applies all changes to the object
     * Returns true on success, false if no transaction scope is available
     *
     * @return bool
     */
    public function commit(): bool;

    /**
     * Ends a transaction scope and discards all changes and rolls back to
     * the state when the transaction has been started
     * Returns true on success, false if no transaction scope is available
     *
     * @return bool
     */
    public function rollback(): bool;
}
