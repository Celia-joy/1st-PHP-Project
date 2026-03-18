<?php
include 'connection.php';

// Get the user id from the URL
$id = $_GET['id'];

// Delete the user
$sql = "DELETE FROM users WHERE id = $id";

if ($conn->query($sql)) {
    header('Location: read.php');
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>