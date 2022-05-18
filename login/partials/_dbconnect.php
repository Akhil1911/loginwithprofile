<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "todos";

$conn = mysqli_connect($servername , $username , $password , $database);
if(!$conn){
    die("Connection Error Due To --->" . mysqli_connect_error());
} 
else{
    // echo "Connected";
}
?>