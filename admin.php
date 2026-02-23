<?php
require 'middleware/auth.php';
require 'config/db.php';
requireAdmin();

// Delete user (Admin only)
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    // Prevent deleting self
    if ($id !== $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: admin.php");
    exit();
}

// Fetch all users
$stmt = $pdo->query("SELECT id, name, email, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Admin Panel</h2>

<p>Welcome Admin <?= htmlspecialchars($_SESSION['user_name']) ?></p>

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
    <td><?= htmlspecialchars($user['name']) ?></td>
    <td><?= htmlspecialchars($user['email']) ?></td>
    <td><?= htmlspecialchars($user['role']) ?></td>
    <td>
        <?php if ($user['id'] != $_SESSION['user_id']): ?>
            <a href="admin.php?delete=<?= $user['id'] ?>" 
               onclick="return confirm('Are you sure?')">
               Delete
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<br>
<a href="logout.php">Logout</a>