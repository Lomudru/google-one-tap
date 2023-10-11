<?php 
session_start();
require "config/config.php";

if(isset($_SESSION["user"])){
    $sql = "SELECT * FROM users WHERE oauth_uid =". $_SESSION["user"];
    $results = mysqli_query($conn, $sql);
    foreach($results as $result){ ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenue <?php echo $result["first_Name"] ?></title>
        </head>
        <body>
        <div>
            <img src="<?php echo $result["picture"] ?>">
            <h1><?php echo $result["first_Name"] . " " . $result["last_Name"]?></h1>
            <h2><?php echo $result["email"] ?></h2>
            <a href="logout.php">Logout</a>
        </div>
        </body>
        </html>
    <?php } 
}

