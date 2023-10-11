<?php
// Utilisation des sessions
session_start();

// Inclure la bibliothèque Google API Client
require_once "vendor/autoload.php";
require "config/config.php";


$id_token = $_POST["id_token"];

$payload = $goo->verifyIdToken($id_token);
$userinfo = [
    "oauth_provider" => "google",
    "oauth_uid" => $payload['sub'],
    "first_Name" => $payload["given_name"],
    "last_Name" => $payload["family_name"],
    "email" => $payload["email"],
    "gender" => "",
    "locale" => $payload["locale"],
    "picture" => $payload["picture"],
];
$_SESSION["user"] = $payload["sub"];

// Envoyer la réponse au côté client
echo "Connecté avec succès. " . $payload["sub"] . ", " . $payload["given_name"] . " " . $payload["family_name"] . ", " . $payload["email"] . ", " . $payload["picture"] . "," . $_POST["OneTap"];

// Vous pouvez maintenant utiliser les données de l'utilisateur comme cela :
// Connexion à la base de données (veuillez remplir les informations de connexion appropriées)
$hostname = "localhost";
$username = "root";
$password = "";
$database = "googleConnect";
$conn = mysqli_connect($hostname, $username, $password, $database);



  
  $sql = "SELECT * FROM users WHERE email = '{$userinfo['email']}'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
      $userdata = mysqli_fetch_assoc($result);
      $token = $userinfo['oauth_uid'];
  }else{
      $sql = "INSERT INTO users (oauth_provider, oauth_uid, first_Name, last_Name, email, gender, locale, picture, created) 
      VALUES ('{$userinfo['oauth_provider']}', '{$userinfo['oauth_uid']}', '{$userinfo['first_Name']}', '{$userinfo['last_Name']}', '{$userinfo['email']}','{$userinfo['gender']}', '{$userinfo['locale']}', '{$userinfo['picture']}', NOW())";
      $result = mysqli_query($conn, $sql);
      if($result){
          $token = $userinfo['oauth_uid'];
      }else{
          echo "user not created";
          die();
      }
  }
  
  ?>
  