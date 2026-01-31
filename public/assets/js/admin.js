fetch("/api/admin_users.php")
  .then(res => res.json())
  .then(users => {
    const tbody = document.querySelector("#users-table tbody");
    tbody.innerHTML = "";

    users.forEach(user => {
      const tr = document.createElement("tr");

      let roleButton = "";

      if (user.role === "admin") {
        roleButton = `
          <button class="admin-btn danger"
                  onclick="updateRole(${user.id}, 'user')">
            Demote
          </button>
        `;
      } else {
        roleButton = `
          <button class="admin-btn primary"
                  onclick="updateRole(${user.id}, 'admin')">
            Make Admin
          </button>
        `;
      }

      tr.innerHTML = `
        <td>${user.id}</td>
        <td>${user.username}</td>
        <td>${user.role}</td>
        <td>
          ${roleButton}
          <button class="admin-btn danger"
                  onclick="deleteUser(${user.id})">
            Delete
          </button>
        </td>
      `;

      tbody.appendChild(tr);
    });
  });

function updateRole(id, role) {
  fetch("/admin/update_role.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `user_id=${id}&role=${role}`
  })
  .then(() => location.reload());
}

function deleteUser(id) {
  fetch("/admin/delete_user.php?id=" + id)
    .then(() => location.reload());
}
