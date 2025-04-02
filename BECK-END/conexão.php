<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "acervorct"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Falha na conexão: " . mysqli_connect_error());
}
echo "Conexão bem-sucedida";
mysqli_close($conn);
?>