<?php
include 'includes/config.php';

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);
    $stmt = $con->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: view_tasks.php?message=Task deleted successfully");
    } else {
        header("Location: view_tasks.php?error=Failed to delete task");
    }
} else {
    header("Location: view_tasks.php?error=Invalid task ID");
}

exit();
