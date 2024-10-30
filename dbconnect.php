<?php

try {
    $host = "localhost";
    $dbname = "vlogify";
    $dbuser = "root";
    $dbpassword = "";

    // Data Source Name
    $dsn = "mysql:host=$host;dbname=$dbname";
    $conn = new PDO($dsn,$dbuser,$dbpassword);

    // or

    // $conn = new PDO("mysql:host=localhost;dbname=vlogify","root","");

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    // echo "connection successful";

} catch (PDOException $e) {
    die("Connection fail:".$e->getMessage());
}   