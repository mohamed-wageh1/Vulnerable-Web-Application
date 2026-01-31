const params = new URLSearchParams(window.location.search);
document.getElementById("user").innerHTML = params.get("name");

if (name) {
    document.getElementById("profile-name").innerHTML = name;
}