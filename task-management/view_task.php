<?php
include 'includes/config.php';
include 'includes/header.php';

$result = $con->query("SELECT * FROM tasks ORDER BY due_date ASC");
?>

<div class="container my-5">
    <h2 class="text-center">Task List</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['task_name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['due_date'] ?></td>
                    <td>
                        <a href="edit-task.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Edit</a>
                        <button onclick="confirmDelete(<?= $row['id'] ?>)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(taskId) {
        if (confirm("Are you sure you want to delete this task?")) {
            window.location.href = `delete-task.php?id=${taskId}`;
        }
    }
</script>

<?php include 'includes/footer.php'; ?>