<?php
    include("php/db.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>p/Rlace</title>
</head>

<body>
    <?php
    if(!isset($_SESSION['Username'])){
        echo("Non connecté");
    } else {
        echo("Bienvenue " . $_SESSION["Username"] . " !");
    }

    if(!isset($_POST["disconnect"])) {
        session_destroy();
        header("index.php");
    }
    ?>
    <form action="index.php" method="POST">
    <div style='float: right;'>
    <input type="submit" name="disconnect" value="Disconnect" id="btnDisconnect"></input>
    </div>
    </form>
    <div class="registrationForm">
        <h1>THE NEW p/Rlace</h1>
        <form action="index.php" method="POST" class="form">
            <label for="nick">Enter your pseudo: </label>
            <input type="text" name="pseudo" id="nick" placeholder="Pseudo" required></input>
            <br><br>
            <label for="mail">Enter your email: </label>
            <input type="email" name="email" id="mail" placeholder="Email" required></input>
            <br><br>
            <label for="passwd">Enter your password: </label>
            <input type="password" name="password" id="passwd" placeholder="Password" required></input>
            <br><br>
            <label for="cpasswd">Confirm your password: </label>
            <input type="password" name="cpassword" id="cpasswd" placeholder="Password" required></input>
            <br><br>
            <a href="connexion.php">Connexion</a>
            <br><br>
            <input type="submit" value="Submit">
        </form>
        <button onClick="erase()" id = "btnSubmit" name="sending">Erase</button>
    <?php
        if(isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["cpassword"])){
            if(!empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["cpassword"])){
                $pseudo = $_POST['pseudo'];
                $email = $_POST['email'];
                $passwd = $_POST['password'];
                $cpasswd = $_POST['cpassword'];
                if($passwd != $cpasswd){
                    echo("<h1 style = 'color: white;'>Password doesn't match</h1>");
                } else {
                    $query = "SELECT * FROM registration WHERE pseudoUser ='$pseudo' OR emailUser = '$email'";
                    $result = mysqli_query($con,$query);
                    if($result->num_rows > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if($row['emailUser'] == $email){
                            echo("<p>Error ! Email already exist !");
                        }   
                        echo("Email user: " . $row['emailUser']);
                        echo("Email entered: " . $email);
                        if ($row['pseudoUser'] == $pseudo) {
                            echo("<p>Error ! Username already exist !");
                        }
                    } else {
                        $query = "insert into registration (pseudoUser, emailUser, passwordUser) values ('$pseudo','$email','$passwd')";
                        mysqli_query($con,$query);
                        header("index.php");
                    }
                }
            } else {
                echo("<p style='color: white;text-align:center'>You must complete all the inputs !</p>");
            }
        } else {
        }
    ?>
    </div>
    <script>
        function erase(){
            var test = []
            test[0] = document.getElementById("nick")
            test[1] = document.getElementById("mail")
            test[2] = document.getElementById("passwd")
            test[3] = document.getElementById("cpasswd")
            for(let i = 0 ; i < test.length ; i++){
                test[i].value = ""
            }
        }

    </script>
</body>

</html>