document.addEventListener("DOMContentLoaded", function() {
    loadUsers();
});

let users = [
    { name: "John Doe", email: "johndoe@example.com", role: "Admin" },
    { name: "Jane Smith", email: "janesmith@example.com", role: "Editor" }
];

function loadUsers() {
    let table = document.getElementById("userTable");
    table.innerHTML = "";

    users.forEach((user, index) => {
        let row = table.insertRow();
        row.innerHTML = `
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>
                <button onclick="editUser(${index})">Edit</button>
                <button onclick="deleteUser(${index})" style="background:red;">Delete</button>
            </td>
        `;
    });
}

function openModal() {
    document.getElementById("userModal").style.display = "block";
}

function closeModal() {
    document.getElementById("userModal").style.display = "none";
}

function addUser() {
    let name = document.getElementById("userName").value;
    let email = document.getElementById("userEmail").value;
    let role = document.getElementById("userRole").value;

    if (name && email && role) {
        users.push({ name, email, role });
        closeModal();
        loadUsers();
    } else {
        alert("Please fill all fields.");
    }
}

function editUser(index) {
    let newRole = prompt("Enter new role (Admin, Editor, Viewer):", users[index].role);
    if (newRole) {
        users[index].role = newRole;
        loadUsers();
    }
}

function deleteUser(index) {
    if (confirm("Are you sure you want to delete this user?")) {
        users.splice(index, 1);
        loadUsers();
    }
}
