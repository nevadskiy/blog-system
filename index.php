<?php

//That is Front Controller

// Must be deleted after release;
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'app/bootstrap.php';

$app = new Router;