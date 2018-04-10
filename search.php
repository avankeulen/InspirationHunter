<?php


$search = $_GET['search'];
$query = "SELECT * FROM posts WHERE description LIKE '{$search}'";
$conn = new PDO("mysql:host=localhost;dbname=inspiration", "root", "root");
$stmt = $conn->prepare($query);

$stmt->execute();

$result = $stmt->fetchAll();