if (localStorage.getItem("role") == "admin") {
    document.body.classList.add("admin");
}

const role = localStorage.getItem("role");

if (role === "admin") {
    document.body.classList.add("admin");
}

function fakeLoginAsAdmin() {
    localStorage.setItem("role", "admin");
    localStorage.setItem("user_id", "1");
    location.reload();
}