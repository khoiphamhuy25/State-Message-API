<?php

require_once('src/msgHandler.php');

$handler = new msgHandler('A011207201002002010001208');

$response = $handler->parse();

echo $response;
