document.addEventListener("DOMContentLoaded", function() {
    const orders = [
        { id: "001", name: "Alice", items: "Latte, Croissant", total: "$8.50", status: "Completed" },
        { id: "002", name: "Bob", items: "Espresso, Muffin", total: "$6.75", status: "Pending" },
        { id: "003", name: "Charlie", items: "Cappuccino", total: "$4.25", status: "Cancelled" },
        { id: "004", name: "Diana", items: "Mocha, Bagel", total: "$10.00", status: "Completed" }
    ];

    const ordersTable = document.getElementById("ordersTable");

    orders.forEach(order => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${order.id}</td>
            <td>${order.name}</td>
            <td>${order.items}</td>
            <td>${order.total}</td>
            <td class="status ${order.status.toLowerCase()}">${order.status}</td>
        `;
        ordersTable.appendChild(row);
    });
});
