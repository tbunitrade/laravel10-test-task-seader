<!DOCTYPE html>
<html>
<head>
    <title>User List and Add New User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<h1>Users List</h1>
<div id="users"></div>
<button id="load-more">Show more</button>

<h1>Add New User</h1>
<form id="add-user-form" action="/api/users" method="post">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Add User</button>
</form>

<script>
    let currentPage = 1;

    function loadUsers(page) {
        fetch(`/api/users?page=${page}`)
            .then(response => response.json())
            .then(data => {
                const userDiv = document.getElementById('users');
                userDiv.innerHTML += data.data.map(user => `<p>${user.name} (${user.email})</p>`).join('');
                if (data.next_page_url) {
                    currentPage++;
                } else {
                    document.getElementById('load-more').style.display = 'none';
                }
            })
            .catch(error => console.error('Error loading users:', error));
    }

    document.getElementById('load-more').addEventListener('click', () => {
        loadUsers(currentPage);
    });

    document.getElementById('add-user-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('/api/users', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User added successfully');
                    loadUsers(1); // Refresh the user list
                } else {
                    alert('Error adding user');
                }
            })
            .catch(error => console.error('Error adding user:', error));
    });

    // Load the first page of users on initial load
    loadUsers(currentPage);
</script>

</body>
</html>
