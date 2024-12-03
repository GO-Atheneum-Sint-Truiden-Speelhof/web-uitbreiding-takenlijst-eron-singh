<!doctype html>
<html lang="nl">


<body>
<?php include("include/head.php"); ?>
<?php include("include/nav.php"); ?>

    <h1>Login</h1>
    <?php
    if (isset($_POST["username"]) && !empty($_POST["username"])) {
        $servername = 'localhost';
        $database = "taak";
        $db_user = 'root';
        $db_password = '';

        $conn = new mysqli($servername, $db_user, $db_password, $database);
        if ($conn->connect_errno) {
            echo 'Failed to connect: ' . $conn->connect_error;
            exit;
        }

        $qry = "SELECT wachtwoord FROM login WHERE username = '" . $_POST["username"] . "'";
         
        $result = $conn->query($qry);
        
        if ($result && $result->num_rows > 0) {
            $rij = $result->fetch_row();
            $p = $rij[0];
            if (password_verify($_POST["paswoord"], $p)) {
                echo "Inloggen succesvol!";
                echo '<script>
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 1000); 
                </script>';
                exit; 
            }
            
            else {
                echo "Ongeldig wachtwoord.";
                
            }
        } else {
            echo "Gebruiker niet gevonden.";
        }
    } else {
        ?>
        <form action="login.php" method="post">
            <label for="username">Gebruikersnaam:</label>
            <input name="username" id="username" type="text" required>
            <label for="passwoord">Paswoord:</label>
            <input name="paswoord" id="paswoord" type="password" required>
            <button type="submit">Login</button>
        </form>
        <?php
    }
    ?>
</body>
</html>
