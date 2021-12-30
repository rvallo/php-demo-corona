<?php
session_start();
require 'config.inc';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);