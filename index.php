<?php
    include("php/db.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="script.js"></script>
    <title>p/Rlace</title>
</head>

<body>

    <div class="registrationForm">
        <h1>THE NEW p/Rlace</h1>
        <form action="treatment.php" method="POST" class="form">
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
            <button type="submit">Submit
        </form>
        <button onClick="teste()" id = "btnSubmit">Erase
    </div>
    <script>
        function teste(){
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