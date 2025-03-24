document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form from submitting normally

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Dummy login credentials (You can replace this with a real authentication system)
    const validEmail = "marjoriejoyadame@gmail.com";
    const validPassword = "032822";


    if (email === validEmail && password === validPassword) {
        // Store login state
        localStorage.setItem("loggedIn", "true");

        // Redirect to main page
        window.location.href = "mainpage.html";
    } else {
        alert("Invalid Email or Password. Try Again!");
    }
});
