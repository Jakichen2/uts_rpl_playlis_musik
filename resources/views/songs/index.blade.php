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

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Daftar Lagu</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success bg-green-100 text-green-700 p-4 mb-4 rounded-lg border-l-4 border-green-500">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel untuk menampilkan daftar lagu -->
    <table class="table-auto w-full text-left border-collapse bg-white shadow-md rounded-lg">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border-b">Judul Lagu</th>
                <th class="px-4 py-2 border-b">Artis</th>
                <th class="px-4 py-2 border-b">Durasi</th>
                <th class="px-4 py-2 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($songs as $song)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $song->title }}</td>
                    <td class="px-4 py-2 border-b">{{ $song->artist }}</td>
                    <td class="px-4 py-2 border-b">{{ $song->duration }}</td>
                    <td class="px-4 py-2 border-b flex space-x-2">
                        <a href="{{ route('songs.edit', $song) }}" class="btn btn-warning px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>

                        <form action="{{ route('songs.destroy', $song) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('songs.create') }}" class="btn btn-primary mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Tambah Lagu Baru</a>

</body>
</html>
