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

    <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Tambah Lagu Baru</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success bg-green-100 text-green-700 p-4 mb-4 rounded-lg border-l-4 border-green-500">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form untuk menambah lagu baru -->
    <form action="{{ route('songs.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        @csrf

        <!-- Field untuk judul lagu -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul Lagu</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Field untuk artis -->
        <div class="mb-4">
            <label for="artist" class="block text-sm font-medium text-gray-700">Artis</label>
            <input type="text" name="artist" id="artist" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Field untuk durasi lagu (opsional) -->
        <div class="mb-4">
            <label for="duration" class="block text-sm font-medium text-gray-700">Durasi (Menit)</label>
            <input type="text" name="duration" id="duration" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="misal: 3:45" required>
        </div>

        <!-- Tombol untuk submit form -->
        <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Tambah Lagu</button>
    </form>

</body>
</html>
