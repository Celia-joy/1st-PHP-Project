<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin:*");

$servername="localhost";
$dbname="student_db";
$username="root";
$password="Butare223!";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error){
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];
switch($method){
    case 'GET':

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $result = $conn->query("SELECT * FROM users WHERE id = $id");
    } 
    else {
        $result = $conn->query("SELECT * FROM users");
    }
    $users = [];
    while($row = $result->fetch_assoc()){
        $users[] = $row;
    }
    echo json_encode($users);

    break;

    case 'POST':
        $data=json_decode(file_get_contents("php://input"),true);
        $fname=$conn->real_escape_string($data['fname']);
        $lname=$conn->real_escape_string($data['lname']);
        $email=$conn->real_escape_string($data['email']);
        $password=md5($conn->real_escape_string($data['password']));
        $gender=$conn->real_escape_string($data['gender']);
        $role=$conn->real_escape_string($data['role']);
        $conn->query("INSERT INTO users(fname, lname, email, password, gender, role) VALUES ('$fname', '$lname', '$email', '$password', '$gender', '$role')");
        echo json_encode(["message" => "User created"]);
        break;

    case 'PUT':
    $data=json_decode(file_get_contents("php://input"), true);
    $id=$data['id'];
    $fname=$conn->real_escape_string($data['fname']);
    $lname=$conn->real_escape_string($data['lname']);
    $email=$conn->real_escape_string($data['email']);
    $password=md5($conn->real_escape_string($data['password']));
    $gender=$conn->real_escape_string($data['gender']);
    $role=$conn->real_escape_string($data['role']);
    $conn->query("UPDATE users SET fname='$fname', lname='$lname', email='$email', password='$password', gender='$gender', role='$role' WHERE id=$id");
    echo json_encode(["message"=> "User updated"]);
    break;

    case 'DELETE':
        $id=$_GET['id'];
        $conn->query("DELETE FROM users WHERE id=$id");
        echo json_encode(["message"=> "User deleted"]);
        break;

    default:
        echo json_encode(["error"=> "Invalid request method"]);
        break;
}
$conn->close();
?>