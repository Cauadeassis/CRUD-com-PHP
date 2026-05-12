<?php

$databaseHost = "127.0.0.1";
$databaseUser = "phpuser";
$databasePassword = "123456";
$databaseName = "caua";
$databasePort = "3306";

$databaseConnection = mysqli_connect(
    $databaseHost,
    $databaseUser,
    $databasePassword,
    $databaseName,
    $databasePort
);

if (!$databaseConnection) die("Database connection failed: " . mysqli_connect_error());
