<?php
require 'middleware/auth.php';
requireLogin();
?>

<h2>Dashboard</h2>

<p>Welcome <?= htmlspecialchars($_SESSION['user_name']) ?></p>
<p>Your role: <?= htmlspecialchars($_SESSION['user_role']) ?></p>

<br>
<a href="logout.php">Logout</a>