document.getElementById("profileForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let address = document.getElementById("address").value;
    let phone = document.getElementById("phone").value;
    let email = document.getElementById("email").value;
    let workingHours = document.getElementById("workingHours").value;

    alert("Profile updated successfully!");
    
    console.log({
        address: address,
        phone: phone,
        email: email,
        workingHours: workingHours
    });
});
