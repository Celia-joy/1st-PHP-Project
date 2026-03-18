<?php
session_start();
include 'connection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Check if admin or regular user
        if ($user['role'] == 'admin') {
            $_SESSION['user']  = $user;
            $_SESSION['role']  = 'admin';
            header('Location: dashboard.php');
            exit();
        } else {
            $_SESSION['user']  = $user;
            $_SESSION['role']  = 'user';
            header('Location: profile.php');
            exit();
        }
    } else {
        $error = 'Invalid email or password.';
    }
}
?>

<html>
    <head>
        <title>Login</title>
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
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .container {
                background: white;
                padding: 40px;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.12);
                width: 100%;
                max-width: 420px;
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

            input {
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

            input:focus {
                border-color: #17a2b8;
            }

            .error {
                background: #fff5f5;
                color: #e53e3e;
                padding: 10px 14px;
                border-radius: 8px;
                font-size: 13px;
                margin-bottom: 16px;
                border-left: 4px solid #e53e3e;
            }

            .btn-login {
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

            .btn-login:hover {
                opacity: 0.9;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(23,162,184,0.4);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>🔐 Login</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </body>
</html>