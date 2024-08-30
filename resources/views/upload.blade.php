<!DOCTYPE html>
<html>
<head>
    <title>User List and Image Upload</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Users List</h1>
<div id="users"></div>
<button id="load-more" onclick="loadMoreUsers()">Show more</button>

<h1>Upload Image</h1>
<form action="/upload-image" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required>
    <button type="submit">Upload</button>
</form>

<h1>Add New User</h1>
<form id="addUserForm">
    @csrf
    <input type="text" name="name" placeholder="Name" >
    <input type="email" name="email" placeholder="Email" >
    <input type="password" name="password" placeholder="Password" >
    <button type="submit">Add User</button>
</form>

<script>
    let currentPage = 1;

    function loadMoreUsers() {
        currentPage++;
        fetchUsers(currentPage);
    }

    function fetchUsers(page = 1) {
        fetch(`/api/users?page=${page}`)
            .then(response => response.json())
            .then(data => {
                const userDiv = document.getElementById('users');
                data.data.forEach(user => {
                    const userElement = document.createElement('p');
                    userElement.textContent = `${user.name} (${user.email})`;
                    userDiv.appendChild(userElement);
                });
            })
            .catch(error => console.error('Error fetching users:', error));
    }

    // Загрузка первых пользователей при открытии страницы
    fetchUsers();

    // Обработка отправки формы добавления пользователя
    document.getElementById('addUserForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: document.querySelector('input[name="name"]').value,
                email: document.querySelector('input[name="email"]').value,
                password: document.querySelector('input[name="password"]').value
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(error => Promise.reject(error));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.success);
            } else {
                alert('Error adding user: ' + (data.error || 'Undefined error.'));
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>
