<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'] ?? null;

if ($user_id) {
    // 1. Delete user from DB
    $sql = "DELETE FROM register WHERE user_id = {$user_id}";
    if (mysqli_query($connect, $sql)) {
        // 2. Destroy session 
        session_unset();
        session_destroy();

        header("Location: login.php");
        exit();
    } else {
        echo "<p style='color:red;margin: 10px 0;'>Unable to delete the user account.</p>";
    }
} else {
    echo "<p style='color:red;margin: 10px 0;'>User not logged in.</p>";
}
?>
