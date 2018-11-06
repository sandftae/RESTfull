<?php
header('Content-Type: application/json');

include 'autoload.php';

$parse = new \Controllers\Parse();

$data = file_get_contents('php://input');

$parse->run($_SERVER, $data);
