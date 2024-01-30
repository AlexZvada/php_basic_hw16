<?php

const APP_DIR = __DIR__ . '/';
require_once APP_DIR . "traits/Validation.php";
require_once APP_DIR . "enums/EmployeeRole.php";
require_once APP_DIR . "classes/Employee.php";
require_once APP_DIR . "classes/EmployeeAccount.php";


try {
    $alex = new Employee('Alex',EmployeeRole::CONSULTANT,  56, );
    $alexAccount = new EmployeeAccount(12345678, 0);
    $info = $alex->info();
    var_dump($info);
}
catch (Exception $exception){
    echo $exception->getMessage() . PHP_EOL;
}
