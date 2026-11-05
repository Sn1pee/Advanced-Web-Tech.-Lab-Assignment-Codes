<?php

$conn = new mysqli("localhost", "root", "", "dtu_students");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

?>