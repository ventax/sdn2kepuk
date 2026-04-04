<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ $user->name }}" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ $user->email }}" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('admin.users.index') }}">Kembali</a>
</body>
</html>
