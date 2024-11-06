<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit Playlist</h1>

    <form action="{{ route('playlists.update', $playlist) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama Playlist</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $playlist->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Playlist</button>
    </form>
</body>
</html>