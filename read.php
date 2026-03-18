<?php
include 'connection.php';
$sql = 'SELECT * FROM users';
$result = $conn->query($sql);
?>

<html>
    <head>
        <title>Users Management</title>
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
                max-width: 900px;
                margin: 0 auto;
                background: white;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
                padding: 40px;
            }

            h2 {
                color: #1a1a2e;
                font-size: 26px;
                font-weight: 600;
                margin-bottom: 24px;
                padding-bottom: 12px;
                border-bottom: 3px solid #17a2b8;
                display: inline-block;
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

            tbody tr:last-child {
                border-bottom: none;
            }

            tbody td {
                padding: 14px 16px;
                color: #4a5568;
                font-size: 14px;
            }

            /* ID column badge */
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
                letter-spacing: 0.4px;
            }

            .btn-edit {
                background-color: #17a2b8;
                color: white;
            }

            .btn-edit:hover {
                background-color: #117a8b;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
            }

            .btn-delete {
                background-color: #e53e3e;
                color: white;
                margin-left: 6px;
            }

            .btn-delete:hover {
                background-color: #c53030;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(229, 62, 62, 0.4);
            }

            /* Empty state */
            .no-data {
                text-align: center;
                padding: 40px;
                color: #a0aec0;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>👥 Users Management</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Gender</th>
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
                            <td colspan="6" class="no-data">No users found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>