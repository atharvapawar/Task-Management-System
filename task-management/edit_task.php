<?php
include 'includes/config.php';
include 'includes/header.php';

// Check if 'id' parameter is set in URL
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Fetch task details from the database
    $stmt = $con->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        echo "Task not found.";
        exit();
    }
}

// Handle form submission for task update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $due_date = $_POST['due_date'];

    // Update task details in the database
    $update_stmt = $con->prepare("UPDATE tasks SET task_name = ?, description = ?, status = ?, due_date = ? WHERE id = ?");
    $update_stmt->bind_param("ssssi", $task_name, $description, $status, $due_date, $taskId);

    if ($update_stmt->execute()) {
        header("Location: view-task.php"); // Redirect to task list
        exit();
    } else {
        echo "Error updating task.";
    }
}
?>

<div class="container my-5">
    <h2>Edit Task</h2>

    <form method="post">
        <div class="mb-3">
            <label for="task_name" class="form-label">Task Name</label>
            <input type="text" class="form-control" id="task_name" name="task_name" value="<?= htmlspecialchars($task['task_name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($task['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="<?= $task['due_date'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>