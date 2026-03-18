<?php
include 'connection.php';

$id = $_GET['id'];


$sql = "DELETE FROM users WHERE id = $id";

if ($conn->query($sql)) {
    header('Location: read.php');
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>