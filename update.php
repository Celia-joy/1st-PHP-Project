<?php
include 'connection.php';

// Get the user id from the URL
$id = $_GET['id'];

// Fetch the current user data to pre-fill the form
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname  = $_POST['fname'];
    $lname  = $_POST['lname'];
    $email  = $_POST['email'];
    $gender = $_POST['gender'];

    $sql = "UPDATE users SET fname='$fname', lname='$lname', email='$email', gender='$gender' WHERE id=$id";

    if ($conn->query($sql)) {
        header('Location: read.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<html>
    <head>
        <title>Edit User</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
                font-family: 'Poppins', sans-serif;
                min-height: 100vh;
                padding: 40px 20px;
            }

            .container {
                max-width: 500px;
                margin: 0 auto;
                background: white;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
                padding: 40px;
            }

            h2 {
                color: #1a1a2e;
                font-size: 24px;
                font-weight: 600;
                margin-bottom: 24px;
                padding-bottom: 12px;
                border-bottom: 3px solid #17a2b8;
                display: inline-block;
            }

            .form-group {
                margin-bottom: 18px;
            }

            label {
                display: block;
                font-size: 13px;
                font-weight: 600;
                color: #4a5568;
                margin-bottom: 6px;
            }

            input, select {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                font-size: 14px;
                font-family: 'Poppins', sans-serif;
                color: #4a5568;
                outline: none;
                transition: border 0.2s ease;
            }

            input:focus, select:focus {
                border-color: #17a2b8;
            }

            .btn-update {
                width: 100%;
                padding: 12px;
                background: linear-gradient(135deg, #17a2b8, #117a8b);
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
                transition: all 0.2s ease;
                margin-top: 10px;
            }

            .btn-update:hover {
                opacity: 0.9;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
            }

            .btn-back {
                display: inline-block;
                margin-top: 16px;
                color: #17a2b8;
                text-decoration: none;
                font-size: 13px;
                font-weight: 600;
            }

            .btn-back:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>✏️ Edit User</h2>
            <form action="update.php?id=<?php echo $id; ?>" method="post">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" value="<?php echo $row['fname']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" value="<?php echo $row['lname']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="Male"   <?php if ($row['gender'] == 'Male')   echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>
                <button type="submit" class="btn-update">💾 Save Changes</button>
            </form>
            <a class="btn-back" href="read.php">← Back to Users</a>
        </div>
    </body>

    
