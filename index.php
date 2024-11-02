<?php
require_once 'models/User.php';

$user = new User();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $user->create($_POST['name'], $_POST['email']);
                break;
            case 'update':
                $user->update($_POST['id'], $_POST['name'], $_POST['email']);
                break;
            case 'delete':
                $user->delete($_POST['id']);
                break;
        }
    }
    header('Location: index.php');
    exit;
}

// Get all users
$users = $user->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PHP SQLite CRUD</title>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    form {
        margin: 20px 0;
    }

    input[type="text"] {
        padding: 5px;
        margin: 5px;
    }
    </style>
</head>

<body>
    <h2>Add New User</h2>
    <form method="POST">
        <input type="hidden" name="action" value="create">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="email" placeholder="Email" required>
        <input type="submit" value="Add User">
    </form>

    <h2>Users List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo $user['created_at']; ?></td>
            <td>
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>