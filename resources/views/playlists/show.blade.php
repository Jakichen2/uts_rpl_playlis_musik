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

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">{{ $playlist->name }}</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success bg-green-100 text-green-700 p-4 mb-4 rounded-lg border-l-4 border-green-500">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar lagu di playlist -->
    <h3 class="text-xl font-semibold mb-4">Daftar Lagu:</h3>
    <ul id="sortable" class="space-y-3">
        @foreach ($playlist->songs as $song)
            <li class="song-item p-4 bg-white rounded-lg shadow-md flex justify-between items-center" data-id="{{ $song->id }}">
                <span class="text-lg">{{ $song->title }} - {{ $song->artist }}</span>

                <!-- Form untuk menghapus lagu dari playlist -->
                <form action="{{ route('playlists.removeSong', [$playlist, $song]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>

    <!-- Form untuk menambah lagu -->
    <form action="{{ route('playlists.addSong', $playlist) }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="song_id" class="block text-sm font-medium text-gray-700">Pilih Lagu</label>
            <select name="song_id" required class="mt-1 p-2 border border-gray-300 rounded-lg w-full">
                @foreach ($songs as $song)
                    <option value="{{ $song->id }}">{{ $song->title }} - {{ $song->artist }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Lagu</button>
    </form>

    <!-- Form untuk mengubah urutan lagu -->
    <form action="{{ route('playlists.updateOrder', $playlist) }}" method="POST" id="update-order-form" class="mt-6">
        @csrf
        <input type="hidden" name="songs[]" id="song-order-input">
        <button type="submit" class="btn btn-success px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Update Urutan</button>
    </form>

    <!-- JavaScript untuk drag-and-drop dan mengubah urutan lagu -->
    <script>
        const sortable = document.getElementById('sortable');
        sortable.addEventListener('dragend', function() {
            const songOrder = [];
            const items = sortable.querySelectorAll('.song-item');
            items.forEach(item => {
                songOrder.push(item.dataset.id);
            });
            document.getElementById('song-order-input').value = songOrder.join(',');
        });
    </script>

</body>
</html>
