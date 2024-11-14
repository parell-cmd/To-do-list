<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM tasks WHERE id = $id");
    $task = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];
    $stmt = $conn->prepare("UPDATE tasks SET task = ? WHERE id = ?");
    $stmt->bind_param("si", $task, $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>
    <h2>Edit Task</h2>
    <form method="post" action="">
        <input type="text" name="task" value="<?= htmlspecialchars($task['task']) ?>" required>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
