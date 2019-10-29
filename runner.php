<?php

use App\Manager;

echo "\n\n\n\n\n\n";

//Your task is to implement an Integer Stack class which implements transactional behaviour and
// supports nested transactions. Nested transaction allow to open another transaction scope
// while a transaction scopes is already open. When committing or rolling back only the latest transaction
//scope is applied or discarded.

$manager = new Manager();
$manager->push(10);     // immediately pushed, because transaction is not started

$manager->commit();             // does nothing, because transaction is not started

$manager->begin();
$manager->push(1);      // push is only enqueued
$manager->push(2);
$manager->push(3);
$manager->pop();

$manager->begin();              // new nested transaction
$manager->push(5);
$manager->push(6);

$manager->commit();
echo $manager->top(), "\n";     // it should have 10, 5 and 6

$manager->commit();
echo $manager->top(), "\n";     // it should have 10, 5, 6, 1, 2

$manager->begin();              // new transaction
$manager->push(7);
$manager->push(8);
$manager->rollback();

echo $manager->top(), "\n";     // it should still have 10, 5, 6, 1, 2

echo $manager->pop(), "\n";     // 2 was popped from the stack

echo $manager->top(), "\n";     // it should still have 10, 5, 6, 1

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