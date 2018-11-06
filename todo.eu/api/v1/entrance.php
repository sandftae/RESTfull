<?php

//header('Access-Controll-Allow-Origin: *');
//header('Content-Type: application/json');

include '../../autoload.php';

$useIt = file_get_contents('php://input');

$runner = new \Controllers\ApiControllers\ApiRunner();

$dataRunner = $runner->parse($_SERVER, $useIt)->retrieve();

echo $dataRunner;
