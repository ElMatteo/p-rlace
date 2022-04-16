<?php
 include('php/db.php');
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
    <div class="connexionForm">
        <h1>Connexion</h1>
    <form action="connexion.php" method="POST" class="connexionForm">
        <label for="nick">Enter your pseudo: </label>
        <input type="text" name="pseudo" id="nick" placeholder="Pseudo" required></input>
        <br><br>
        <label for="password">Enter your password: </label>
        <input type="password" name="passwd" id ="password" placeholder="Password" required></input>
        <br><br>
        <input type="submit" value="Submit"></input>
        <br><br>
        <a href="index.php">Registrer</a>
    </form>

    <?php

    if(isset($_POST["pseudo"]) && isset($_POST["passwd"])){
        if(!empty($_POST["pseudo"]) && !empty($_POST["passwd"])){
            $pseudo = $_POST["pseudo"];
            $passwd = $_POST["passwd"];

            $query=("SELECT * FROM registration WHERE pseudoUser = '$pseudo' AND passwordUser = '$passwd'");
            $result = mysqli_query($con, $query);
            if($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['Username'] = $row['pseudoUser'];
                echo("Welcome: " . $_SESSION["Username"]);
            } else {
                //Pseudo not found
                echo("Incorrect username or password ! ");
            }
        } else {
            //To do
        }
    } else {
        // To do
    }

    ?>
    </div>
</body>
</html>