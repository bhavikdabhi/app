<?php
// Hash the password before inserting it into the database
$admin_username = 'admin';
$admin_password = password_hash('admin', PASSWORD_DEFAULT);

// Insert into the database
require 'db_connection.php';
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $admin_username, $admin_password);
mysqli_stmt_execute($stmt);

echo "Admin user created successfully!";
?>
