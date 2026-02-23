<?php
require 'config/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($name && $email && $password && $role) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");

        try {
            $stmt->execute([$name, $email, $hashedPassword, $role]);
            $message = "Registration successful!";
        } catch (PDOException $e) {
            $message = "Email already exists.";
        }
    }
}
?>

<h2>Register</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    Role:
    <select name="role" required>
        <option value="user">User</option>
        <option value="editor">Editor</option>
        <option value="admin">Admin</option>
    </select>

    <br><br>
    <button type="submit">Register</button>
</form>

<p><?= $message ?></p>

<a href="login.php">Go to Login</a>