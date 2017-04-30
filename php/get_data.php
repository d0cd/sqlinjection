<?php

$servername = "localhost";
$username = "root";
$password = "Gforce98!";
$dbname = "store";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if (!$connect) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "SELECT * FROM secrets WHERE Num=?";

$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'i', $num);

$num = $_GET["num"];


//Don't need to insert id since it's an PRI_KEY A_I
mysqli_stmt_execute($stmt)
or die (mysqli_error($connect));

mysqli_stmt_bind_result($stmt, $firstname, $lastname, $secretmessage, $num);

echo "<table>"; // start a table tag in the HTML

while(mysqli_stmt_fetch($stmt)){   //Creates a loop to loop through results
echo "<tr><td>" . $firstname . "</td><td>" . $lastname . "</td><td>" . $secretmessage . "</td><td>" . $num . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysqli_stmt_close($stmt);

mysqli_close($connect);
?>