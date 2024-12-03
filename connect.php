<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if (isset($_POST['Taaknaam'], $_POST['Title'], $_POST['instructies'], $_POST['Deadline'])) {
    $taaknaam = $_POST['Taaknaam'];
    $title = $_POST['Title'];
    $instructies = $_POST['instructies'];
    $deadline = $_POST['Deadline'];

    $stmt = $conn->prepare("INSERT INTO taak (Taaknaam, Title, instructies, Deadline) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $taaknaam, $title, $instructies, $deadline);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Fout bij toevoegen: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Fout bij voorbereiden van statement: " . $conn->error;
    }
} else {
    echo "Alle velden zijn verplicht!";
}

?>

