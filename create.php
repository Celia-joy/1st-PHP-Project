<?php
include 'connection.php';
if(isset($_POST['submit'])) {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $password =md5($_POST['Password']);
    $gender = $_POST['Gender'];
    
    $sql = "INSERT INTO users (fname, lname, email, password, gender) VALUES ('$firstName', '$lastName', '$email', '$password', '$gender')";
    $result = $conn->query($sql);
    if($result) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
<html>
    <a class="btn-btn-info" href="signup.html"><br><br>Back</a>
    <a class="btn-btn-info" href="read.php"><br><br>View record from database</a>
</html>