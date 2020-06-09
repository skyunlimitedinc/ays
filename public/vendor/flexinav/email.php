<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$body = "From $name, \n\n$message";

$to = "YOUR EMAIL ADDRESS";

mail($to, $email, $body);
?>