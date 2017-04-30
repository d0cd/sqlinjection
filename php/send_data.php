<?php

$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "store";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


$sql = "INSERT INTO secrets (FirstName, LastName, SecretMessage, Num) 
			VALUES (?,?,?,?)";

$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'sssi', $firstname, $lastname, $secret, $num);

$firstname = $_POST["FirstName"];
$lastname = $_POST["LastName"];
$secret = $_POST["SecretMessage"];
$num = $_POST["Num"];


mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


//Don't need to insert id since it's an PRI_KEY A_I
mysqli_close($connect);
header("location: form.html");
?>