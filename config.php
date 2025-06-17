<?php
$connect = mysqli_connect("localhost", "root", "", "e-project");

if (!$connect) {
  die("Connection failed: " . mysqli_connect_error());
}
?>