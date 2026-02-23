<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Delete user
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin.php");
    exit();
}

$stmt = $pdo->query("SELECT id, name, email, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Admin Panel</h2>
<p>Welcome <?= $_SESSION['user_name'] ?></p>

<table border="1" cellpadding="8">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php foreach ($users as $user): ?>
<tr>
    <td><?= $user['id'] ?></td>
    <td><?= $user['name'] ?></td>
    <td><?= $user['email'] ?></td>
    <td><?= $user['role'] ?></td>
    <td>
        <?php if ($user['id'] != $_SESSION['user_id']): ?>
            <a href="admin.php?delete=<?= $user['id'] ?>">Delete</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>

<br>
<a href="logout.php">Logout</a>