<?php
$conn = new PDO('mysql:host=localhost;dbname=comp1006w', 'root', 'root');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>