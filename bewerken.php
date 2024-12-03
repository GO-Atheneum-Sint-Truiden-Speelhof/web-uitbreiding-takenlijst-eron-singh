<?php include("include/head.php"); ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM taak WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Taak niet gevonden!");
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['Taaknaam'], $_POST['Title'], $_POST['instructies'], $_POST['Deadline'])) {
        $id = intval($_POST['id']);
        $taaknaam = $_POST['Taaknaam'];
        $title = $_POST['Title'];
        $instructies = $_POST['instructies'];
        $deadline = $_POST['Deadline'];

        $sql = "UPDATE taak SET Taaknaam = ?, Title = ?, instructies = ?, Deadline = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $taaknaam, $title, $instructies, $deadline, $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Fout bij bijwerken: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Alle velden zijn verplicht!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Taak Bewerken</title>
</head>
<body>
    <h1>Taak Bewerken</h1>
    <form action="bewerken.php" method="post">
        <input type="hidden" name="id" value="<?php echo isset($row['ID']) ? $row['ID'] : ''; ?>">
        <label for="Taaknaam">Taaknaam</label>
        <input type="text" id="Taaknaam" name="Taaknaam" value="<?php echo isset($row['Taaknaam']) ? $row['Taaknaam'] : ''; ?>" required><br><br>
        <label for="Title">Title</label>
        <input type="text" id="Title" name="Title" value="<?php echo isset($row['Title']) ? $row['Title'] : ''; ?>" required><br><br>
        <label for="instructies">Instructies</label>
        <input type="text" id="instructies" name="instructies" value="<?php echo isset($row['instructies']) ? $row['instructies'] : ''; ?>" required><br><br>
        <label for="Deadline">Deadline</label>
        <input type="date" id="Deadline" name="Deadline" value="<?php echo isset($row['Deadline']) ? $row['Deadline'] : ''; ?>" required><br><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>