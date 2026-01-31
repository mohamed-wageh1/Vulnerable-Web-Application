const role = localStorage.getItem("role") || "employee";

fetch("/public/api/admin_stats.php?role=" + localStorage.getItem("role"))
  .then(r => r.json())
  .then(d => console.log(d));
