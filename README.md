# stack

This challenge implemented using 1 main Stack class which implements 2 interfaces: 
- StackInterface
- TransactionableInterface

Stack class itself has 2 incapsulated Spl stacks: 
- stack of transactions
- stack of numbers

The main idea behind this implementation is that transactions are stored in internal stack.
It gives ability to maintain nested transactions functionality. All new open transactions will be stored in stack and once transaction is committed
or discouraged it is being popped from the transactions stack.

Next internal stack is stack of numbers, since the main goal of this challenge is to implement Integer stack.
This internal stack is used to implement main functionality of the challenge..

Once we start pushing numbers to Integer stack and if transaction was not started - numbers are being pushed to numbers stack directly. Once we start transaction
we add transaction to the transactions stack and we add numbers to the transaction on top of the transactions stack.

If transaction started we use commands (Command pattern) to add or pop numbers from the transaction.
Every transaction has queue of recorder commands, every command has access to main internal stack of numbers.
Once we push number to the stack - we create push command and enqueue this command to the queue of commands of top transaction. 

When transaction is committed we dequeue every recorded command and call execute method of every command (pop or push). In such case we maintain main idea of the stack.
When transaction is rolled back - we just reinitialize queue of commands of transaction.

Challenge was structured like this:

- runner.php
- App/

In order to check the implementation of the App execute

```php php runner.php``` 

Main php file print tooltips to the STDOUT so you can analyze it's implementation.

