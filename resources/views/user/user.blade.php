{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
    <a href="{{ route('/user/tambah') }}">Tambah user</a>
    <table border="1" cellpading="2" cellspancing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <td>Kode Level</td>
            <td>Nama Level</td>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id}}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }} </td>
            <td>{{ $d->level_id }}</td>
            <td>{{ $d->level->level_kode }}</td>
            <td>{{ $d->level->level_nama }}</td>
            <td><a href={{ route('/user/ubah',$d->user_id) }}>Ubah</a> | <a href={{ route('/user/hapus',$d->user_id) }}>hapus</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html> --}}