<?php
include 'includes/config.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $stmt = $con->prepare("INSERT INTO tasks (task_name, description, due_date, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("sss", $task_name, $description, $due_date);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Task added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding task.</div>";
    }
}
?>

<h2>Add Task</h2>
<form method="POST">
    <div class="mb-3">
        <label for="task_name" class="form-label">Task Name</label>
        <input type="text" class="form-control" name="task_name" id="task_name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="due_date" class="form-label">Due Date</label>
        <input type="date" class="form-control" name="due_date" id="due_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Task</button>
</form>

<?php include 'includes/footer.php'; ?>