<!doctype html>
<html lang=nl>

<?php include('includes/head.php'); ?>

<body>
<h1>Login</h1>
<?php if (isset(?_POST["username"]) && !empty($_POST["username"])){
    $servername='localhost'
    $database="taak"
    $db_user='root';
    $db_password='';

    $conn= new mysqli($servername, $db_user, $db_pwd,$database);
    if($conn-> connect_errno){
        echo 'Failed to connect: '.$conn-> connnect_error;

    }
    $qry ="SELECT paswoord FROM users WHERE Username = '".$_POST["username"]."";
    echo $qry;
    $result=$conn-> query($qry);
    if($result-> num_rows > 0){
        $rij= $reult -> fetch_row();
        $p= $rij[0];
        if( password_verify($_POST["paswoord"], $p));
        //inloggen
    }else{
        //foutboodschap
    }
}else{
    //formulier tonen
    ?>
    <form action='index.php' method='post'>
    <label for='username'> Gebruikersnaam: </label>
    <input name='username' id='username' type='text'>
    <label for='passwoord'> Paswoord: </label>
    <input name= 'passwoord' id='passwoord' type='password'>
    <button type='submit'> Login</button>
    </form>
    <?php
}
?>
</body>
</html>