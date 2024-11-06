<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Menambahkan Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <h1 class="text-2xl font-bold text-center mb-6">Daftar Playlist</h1>

    @if (session('success'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 border-l-4 border-green-500">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('playlists.create') }}" class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 mb-4 inline-block">Buat Playlist Baru</a>

    <ul class="list-group mt-4 space-y-4">
        @foreach ($playlists as $playlist)
            <li class="list-group-item bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <a href="{{ route('playlists.show', $playlist) }}" class="text-xl text-blue-600 hover:underline">{{ $playlist->name }}</a>
                <div>
                    <a href="{{ route('playlists.edit', $playlist) }}" class="btn btn-warning btn-sm float-end ml-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>

                    <!-- Form untuk menghapus playlist -->
                    <form action="{{ route('playlists.destroy', $playlist) }}" method="POST" style="display:inline;" class="float-end ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</body>
</html>
