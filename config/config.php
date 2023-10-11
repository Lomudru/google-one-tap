<?php

require("vendor/autoload.php");
$goo = new Google\Client();
$httpClient = new GuzzleHttp\Client([
    'verify' => false, // Désactive la vérification du certificat
    'curl' => [
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
    ],
]);
$goo->setHttpClient($httpClient);
$goo->setClientId("Client ID");
$goo->setClientSecret("Client secret");


$hostname = "localhost";
$username = "root";
$password = "";
$database = "googleConnect";

$conn = mysqli_connect($hostname, $username, $password, $database);