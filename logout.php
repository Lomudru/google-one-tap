<?php
// (A) NOT LOGGED IN
session_start();
if (!isset($_SESSION["token"])) {
  header("Location: index.php"); exit;
}

// (B) REMOVE & REVOKE TOKEN
$goo->setAccessToken($_SESSION["token"]);
$goo->revokeToken();
unset($_SESSION["token"]);
unset($_SESSION["user"]);
header("Location: index.php"); exit;