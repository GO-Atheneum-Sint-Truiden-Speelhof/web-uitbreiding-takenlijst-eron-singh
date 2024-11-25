<?php
$servername = "localhost";
$username = "root";
$password = "ishpal";
$dbname = "taak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

$sql = "SELECT ID, Taaknaam, Title, instructies, Deadline FROM taak";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all">
    <link rel="stylesheet" type="text/css" href="opmaak/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="opmaak/opmaak.css">
    <link rel="shortcut icon" type="image/gof" href="plaatjes/logo.webp">
    <title>TaakLijst</title>
</head>


<body>


    <h1>Taakbeheer</h1>

    <div>
        <h2>Nieuwe Taak Toevoegen</h2>
        <form id="Taak" action="connect.php" method="post">
            <label for="taakNaam">Taaknaam</label>
            <input type="text" id="Taaknaam" name="Taaknaam" required><br><br>

            <label for="taakBeschrijving">Title</label>
            <input type="text" id="Title" name="Title" required><br><br>

            <label for="taakBeschrijving">Instructies</label>
            <input type="text" id="instructies" name="instructies" required><br><br>

            <label for="Deadline">Deadline</label>
            <input type="date" id="Deadline" name="Deadline" required><br><br>

            <button type="submit">Toevoegen</button>
        </form>
    </div>

    <h2>Takenlijst</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Taaknaam</th>
                <th>Title</th>
                <th>Instructies</th>
                <th>Deadline</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['Taaknaam']}</td>
                        <td>{$row['Title']}</td>
                        <td>{$row['instructies']}</td>
                        <td>{$row['Deadline']}</td>
                        <td>
                            <a href='bewerken.php?id={$row['ID']}'>Bewerken</a> | 
                            <a href='verwijderen.php?id={$row['ID']}' onclick=\"return confirm('Weet je zeker dat je deze taak wilt verwijderen?');\">Verwijderen</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Geen taken gevonden</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
$conn->close();
?>

