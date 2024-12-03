<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $taaknaam = $conn->real_escape_string($_POST['Taaknaam']);
    $title = $conn->real_escape_string($_POST['Title']);
    $instructies = $conn->real_escape_string($_POST['instructies']);
    $deadline = $conn->real_escape_string($_POST['Deadline']);

    $sql = "INSERT INTO taak (Taaknaam, Title, instructies, Deadline) VALUES ('$taaknaam', '$title', '$instructies', '$deadline')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Taak succesvol toegevoegd!</div>";
    }
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
    
    <script>
        function validateForm() {
            let taaknaam = document.getElementById("Taaknaam").value.trim();
            if (taaknaam === "") {
                alert("Taaknaam mag niet leeg zijn.");
                return false; 
            }
            return true; 
        }
    </script>
</head>

<body>
    <?php include("include/nav.php"); ?>

    <div class="container mt-5">
        <h1 class="text-center">Taakbeheer</h1>

        <div class="mt-4">
            <h2>Nieuwe Taak Toevoegen</h2>
            <form id="Taak" method="post" onsubmit="return validateForm();">
                <div class="col-md-12">
                    <label for="taakNaam" class="form-label">Taaknaam</label>
                    <input type="text" id="Taaknaam" name="Taaknaam" class="form-control">
                </div>
                <div class="col-md-12">
                    <label for="taakBeschrijving" class="form-label">Titel</label>
                    <input type="text" id="Title" name="Title" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label for="taakBeschrijving" class="form-label">Instructies</label>
                    <input type="text" id="instructies" name="instructies" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label for="Deadline" class="form-label">Deadline</label>
                    <input type="date" id="Deadline" name="Deadline" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3">Toevoegen</button>
                </div>
            </form>
        </div>

        <div>
            <h2>Takenlijst</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
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
                                    <a href='bewerken.php?id={$row['ID']}' class='btn btn-sm btn-primary' title='Bewerken'>
                                    <img src='plaatjes/potlood.png' alt='Bewerken' width='20' height='20'>
                                    </a>
                                    <a href='verwijderen.php?id={$row['ID']}' class='btn btn-sm btn-danger' title='Verwijderen' onclick=\"return confirm('Weet je zeker dat je deze taak wilt verwijderen?');\">
                                    <img src='plaatjes/vuilnisbak.png' alt='Verwijderen' width='20' height='20'>
                                     </a>
                                        
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>


