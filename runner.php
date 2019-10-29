<?php

use App\Manager;

$manager = new Manager();
$manager->push(10);     // immediately pushed, because transaction is not started

//$manager->commit();             // does nothing, because transaction is not started
//
//$manager->begin();
//$manager->push(1);      // push is only enqueued
//$manager->push(2);
//$manager->push(3);
//$manager->pop();
//
//$manager->begin();              // new nested transaction
$manager->push(5);
//$manager->push(6);

$manager->commit();

var_dump($manager->top());

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