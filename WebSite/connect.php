<?php
require 'vendor/autoload.php';
error_reporting(E_ERROR | E_PARSE);
$banco = mysqli_connect("localhost", "root", "", "grcd");
$api = new Binance\API();
?>