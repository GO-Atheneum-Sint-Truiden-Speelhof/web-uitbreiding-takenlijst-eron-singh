<!doctype html>
<html lang="nl">


<body>

<?php include("include/head.php"); ?>
<?php include("include/nav.php"); ?>

    <h1>Login</h1>
    <?php
$servername = 'localhost';
$database = "taak";
$db_user = 'root';
$db_password = 'ishpal';

$conn = new mysqli($servername, $db_user, $db_password, $database);
if ($conn->connect_errno) {
    echo 'Failed to connect: ' . $conn->connect_error;
    exit;
}

        $qry = "SELECT wachtwoord FROM login WHERE username = '" . $_POST["username"] . "'";
        echo $qry;
        $result = $conn->query($qry);

        if ($result && $result->num_rows > 0) {
            $rij = $result->fetch_row();
            $p = $rij[0];
            if (password_verify($_POST["wachtwoord"], $p)) {
                echo "Inloggen succesvol!";
            } else {
                echo "Ongeldig wachtwoord.";
            }
        } else {
            echo "Gebruiker niet gevonden.";
        }

        ?>
        <form action="login.php" method="post">
            <label for="username">Gebruikersnaam:</label>
            <input name="username" id="username" type="text" required>
            <label for="wachtwoord">Paswoord:</label>
            <input name="wachtwoord" id="wachtwoord" type="password" required>
            <button type="submit">Login</button>
        </form>
        <?php
    
    ?>
</body>
</html>
