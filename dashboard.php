<?php
session_start();

// Block non-admins
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

include 'connection.php';
$sql    = 'SELECT * FROM users';
$result = $conn->query($sql);
?>

<html>
    <head>
        <title>Admin Dashboard</title>
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
                max-width: 1000px;
                margin: 0 auto;
                background: white;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.12);
                padding: 40px;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 24px;
                padding-bottom: 12px;
                border-bottom: 3px solid #17a2b8;
            }

            h2 {
                color: #1a1a2e;
                font-size: 24px;
                font-weight: 600;
            }

            .welcome {
                font-size: 13px;
                color: #4a5568;
            }

            .btn-logout {
                padding: 8px 18px;
                background: #e53e3e;
                color: white;
                border: none;
                border-radius: 8px;
                font-size: 13px;
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

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
            }

            thead {
                background: linear-gradient(135deg, #1a1a2e, #16213e);
            }

            thead th {
                color: white;
                padding: 14px 16px;
                text-align: left;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 0.8px;
                text-transform: uppercase;
            }

            tbody tr {
                border-bottom: 1px solid #e8edf2;
                transition: background 0.2s ease;
            }

            tbody tr:hover {
                background-color: #f0f9fb;
            }

            tbody td {
                padding: 14px 16px;
                color: #4a5568;
                font-size: 14px;
            }

            tbody td:first-child {
                font-weight: 600;
                color: #17a2b8;
            }

            .btn {
                display: inline-block;
                padding: 7px 16px;
                border-radius: 6px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                border: none;
                transition: all 0.2s ease;
                font-family: 'Poppins', sans-serif;
            }

            .btn-edit {
                background-color: #17a2b8;
                color: white;
            }

            .btn-edit:hover {
                background-color: #117a8b;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(23,162,184,0.4);
            }

            .btn-delete {
                background-color: #e53e3e;
                color: white;
                margin-left: 6px;
            }

            .btn-delete:hover {
                background-color: #c53030;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(229,62,62,0.4);
            }

            .no-data {
                text-align: center;
                padding: 40px;
                color: #a0aec0;
                font-size: 15px;
            }

            .badge-admin {
                background: #17a2b8;
                color: white;
                padding: 2px 8px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
            }

            .badge-user {
                background: #68d391;
                color: white;
                padding: 2px 8px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div>
                    <h2>🛡️ Admin Dashboard</h2>
                    <span class="welcome">Welcome, <?php echo $_SESSION['user']['fname']; ?></span>
                </div>
                <a href="logout.php" class="btn-logout">🚪 Logout</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td>
                                <span class="badge-<?php echo $row['role']; ?>">
                                    <?php echo ucfirst($row['role']); ?>
                                </span>
                            </td>
                            <td>
                                <form action="update.php" method="get" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-edit">✏️ Edit</button>
                                </form>
                                <form action="delete.php" method="get" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-delete">🗑️ Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                    ?>
                        <tr>
                            <td colspan="7" class="no-data">No users found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>