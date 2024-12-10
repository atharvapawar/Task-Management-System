document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".status-update").forEach((select) => {
    select.addEventListener("change", function () {
      const taskId = this.dataset.id;
      const newStatus = this.value;

      fetch("update_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: taskId, status: newStatus }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("Task status updated!");
          } else {
            alert("Failed to update status.");
          }
        });
    });
  });
});
