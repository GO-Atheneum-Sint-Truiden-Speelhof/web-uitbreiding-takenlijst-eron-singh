<!DOCTYPE html>
<html lang="nl">

<head>
	<meta charset=utf-8>
	<meta name="robots" content="all">
	<link rel="stylesheet" type="text/css" href="opmaak/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="opmaak/opmaak.css">
	<title>Taken Lijst</title>
	<script src="scripts/jquery.js"></script>
	<script src="scripts/bootstrap.js"></script>
</head>


<body>
    <div>
        <h1>Taakbeheer</h1>

        <div >
            <div>
                <h2>Nieuwe Taak Toevoegen</h2>
            </div>
            <div>
                <form id="Taak">
                    <div>
                        <label for="taakNaam">Taaknaam</label>
                        <input type="text" id="Taaknaam" name="Taaknaam" required>
                    </div>
                    <br></br>

                    <div>
                        <label for="taakBeschrijving" >Title</label>
                        <input type="text" id="Title" name="Title" required>
                        
                    </div>
                    <br></br>

                    <div>
                        <label for="taakBeschrijving">instructies</label>
                        <input type="text" id="instructies" name="instructies" required>
                    </div>
                    <br></br>

                    <div>
                        <label for="Deadline">Deadline</label>
                        <input type="date" id="Deadline" name="Deadline" required>
                    </div>
                    <br></br>

                    

                    <button type="submit" class="adden">Toevoegen</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
