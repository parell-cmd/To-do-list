<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $stmt = $conn->prepare("INSERT INTO tasks (task) VALUES (?)");
    $stmt->bind_param("s", $task);
    $stmt->execute();
    $stmt->close();
}

$result = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>To-Do List</h1>
    <form method="post" action="">
        <input type="text" name="task" placeholder="Tambah kegiatan baru" required>
        <button type="submit">Tambah</button>
    </form>

    <ul>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <li>
                <?= htmlspecialchars($row['task']) ?>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
