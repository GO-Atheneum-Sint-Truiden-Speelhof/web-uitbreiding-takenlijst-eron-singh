<?php
include("include/head.php");

include 'connect.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM taak WHERE ID = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Fout bij het voorbereiden van de query: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        die("Fout bij het uitvoeren van de query: " . $stmt->error);
    }

    $stmt->close();
} else {
    die("Geen geldige ID opgegeven!");
}

$conn->close();
?>
