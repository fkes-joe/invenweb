<?php
session_start();
include('../config/conn.php'); // Ensure this path is correct

// Define the encrypt function if it's not already defined
function encrypt($string) {
    return base64_encode($string); // Example implementation
}

// Check if the connection is successful
if ($con) {
    if (isset($_GET['act']) && $_GET['act'] == encrypt('ganti_pass')) {
        $id = $_POST['id'];
        $new_password = $_POST['password'];

        // Validate input
        if (!empty($new_password)) {
            // Hash new password for security
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password in database
            $query = "UPDATE tb_user SET password = ? WHERE id_user = ?";
            $stmt = $con->prepare($query); // Use $con here for MySQLi

            if ($stmt) {
                $stmt->bind_param('si', $hashed_password, $id);

                if ($stmt->execute()) {
                    $_SESSION['success'] = "Password berhasil diubah.";
                } else {
                    $_SESSION['error'] = "Gagal mengubah password.";
                }

                $stmt->close();
            } else {
                $_SESSION['error'] = "Database query preparation failed.";
            }
        } else {
            $_SESSION['error'] = "Password tidak boleh kosong.";
        }

        header("Location: ".$base_url."login.php"); // Redirect back to main page
        exit();
    }
} else {
    die("Database connection failed: " . mysqli_connect_error());
}
?>