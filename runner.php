<?php

use App\Stack;

echo "\n\n\n\n\n\n";

//Your task is to implement an Integer Stack class which implements transactional behaviour and
// supports nested transactions. Nested transaction allow to open another transaction scope
// while a transaction scopes is already open. When committing or rolling back only the latest transaction
//scope is applied or discarded.

$stack = new Stack();
$stack->push(10);     // immediately pushed, because transaction is not started

$stack->commit();             // does nothing, because transaction is not started

$stack->start();
$stack->push(1);      // push is only enqueued
$stack->push(2);
$stack->push(3);
$stack->pop();

$stack->start();              // new nested transaction
$stack->push(5);
$stack->push(6);

$stack->commit();
echo $stack->top(), "\n";     // it should have 10, 5 and 6

$stack->commit();
echo $stack->top(), "\n";     // it should have 10, 5, 6, 1, 2

$stack->start();              // new transaction
$stack->push(7);
$stack->push(8);
$stack->rollback();

echo $stack->top(), "\n";     // it should still have 10, 5, 6, 1, 2

echo $stack->pop(), "\n";     // 2 was popped from the stack

echo $stack->top(), "\n";     // it should still have 10, 5, 6, 1

function __autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    // $fileName .= $className . '.php'; //sometimes you need a custom structure
    //require_once "library/class.php"; //or include a class manually
    require $fileName;

}