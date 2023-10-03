<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $message = $_POST['ndc_message'];

    include_once '..\src\msgHandler.php';

    $handler = new msgHandler($message);

    $response = $handler->parse();

    echo $response;

    exit();
}