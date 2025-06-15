<form action="{{ url('register') }}" method="POST">
    @csrf

    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <label>Nama:</label><br>
    <input type="text" name="nama" required><br>

    <label>Level ID:</label><br>
    <input type="text" name="level_id" required><br>

    <button type="submit">Daftar</button>
</form>
