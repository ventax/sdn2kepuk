<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <h1>Tambah User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="name" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('admin.users.index') }}">Kembali</a>
</body>
</html>
