<!DOCTYPE html>
<html>
<head>
    <title>User List and Image Upload</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Users List</h1>
<div id="users"></div>

<h1>Upload Image</h1>
<form action="/upload-image" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required>
    <button type="submit">Upload</button>
</form>

<script>
    fetch('/api/users')
        .then(response => response.json())
        .then(data => {
            const userDiv = document.getElementById('users');
            userDiv.innerHTML = data.data.map(user => `<p>${user.name} (${user.email})</p>`).join('');
        });

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('CSRF Token:', token);
</script>
</body>
</html>
