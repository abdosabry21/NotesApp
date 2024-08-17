<?php 
session_start();
$username=$_SESSION["username"];
$tablename=$username."_notes";




$id= $_GET['id']; 
$conn=$conn=mysqli_connect('localhost','root','','mynotesapp');
$sql="DELETE FROM `$tablename` WHERE `id`=$id";
$result= mysqli_query($conn,$sql);
header("location: ../notes.php")

?>