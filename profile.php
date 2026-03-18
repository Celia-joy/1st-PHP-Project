<?php
session_start();

// Block non-logged-in users
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['user'];
?>

<html>
    <head>
        <title>My Profile</title>
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
                text-align: center;
            }

            .avatar {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #17a2b8, #117a8b);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                margin: 0 auto 20px;
            }

            h2 {
                color: #1a1a2e;
                font-size: 22px;
                font-weight: 600;
                margin-bottom: 6px;
            }

            .email {
                color: #a0aec0;
                font-size: 13px;
                margin-bottom: 24px;
            }

            .info-box {
                background: #f7fafc;
                border-radius: 10px;
                padding: 16px;
                margin-bottom: 16px;
                text-align: left;
            }

            .info-box label {
                font-size: 11px;
                font-weight: 600;
                color: #a0aec0;
                text-transform: uppercase;
                letter-spacing: 0.8px;
            }

            .info-box p {
                font-size: 15px;
                color: #1a1a2e;
                font-weight: 600;
                margin-top: 4px;
            }

            .btn-logout {
                display: inline-block;
                margin-top: 10px;
                padding: 10px 24px;
                background: #e53e3e;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                font-family: 'Poppins', sans-serif;
                text-decoration: none;
                transition: all 0.2s ease;
            }

            .btn-logout:hover {
                background: #c53030;
                transform: translateY(-1px);
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="avatar">👤</div>
            <h2><?php echo $user['fname'] . ' ' . $user['lname']; ?></h2>
            <p class="email"><?php echo $user['email']; ?></p>

            <div class="info-box">
                <label>Gender</label>
                <p><?php echo $user['gender']; ?></p>
            </div>
            <div class="info-box">
                <label>Role</label>
                <p><?php echo ucfirst($user['role']); ?></p>
            </div>

            <a href="logout.php" class="btn-logout">🚪 Logout</a>
        </div>
    </body>
</html>