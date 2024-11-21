<?php
$servername = "localhost";
$username = "root";
$password = "ishpal";
$dbname = "taak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

$taaknaam = $_POST['Taaknaam'];
$title = $_POST['Title'];
$instructies = $_POST['instructies'];
$deadline = $_POST['Deadline'];

$sql = "INSERT INTO taak (Taaknaam, Title, instructies, Deadline) VALUES ('$taaknaam', '$title', '$instructies', '$deadline')";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit;
} else {
    echo "Fout bij toevoegen: " . $conn->error;
}

$conn->close();
?>
