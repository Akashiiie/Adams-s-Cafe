document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll("tbody input[type='checkbox']");
    const updateButton = document.querySelector(".update-btn");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            let selectedCount = document.querySelectorAll("tbody input[type='checkbox']:checked").length;
            document.querySelector(".order-controls span").textContent = `(${selectedCount}) selected`;
        });
    });

    updateButton.addEventListener("click", function() {
        alert("Order statuses updated!");
    });
});
