<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<h2>Welcome <?= $_SESSION['user_name'] ?></h2>
<p>Your role: <?= $_SESSION['user_role'] ?></p>

<a href="logout.php">Logout</a>