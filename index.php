<?php
header("Location: landing/landing.php");
exit();

// session_start();

// // If user is not logged in, redirect to login
// if (!isset($_SESSION['user_id'])) {
//     header("Location: auth/login.php");
//     exit();
// }

// // Redirect based on role
// if ($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 2) {
//     header("Location: dashboard/employee.php");
//     exit();
// } elseif ($_SESSION['role_id'] == 3) {
//     header("Location: dashboard/management.php");
//     exit();
// } elseif ($_SESSION['role_id'] == 4){
//     header("Location: dashboard/admin.php");
// }
// } else {
//     // Unknown role or error
//     session_destroy();
//     header("Location: auth/login.php");
//     exit();
// }
?>
