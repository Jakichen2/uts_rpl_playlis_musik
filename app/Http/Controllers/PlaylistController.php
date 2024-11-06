<?php

namespace App\Http\Controllers;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
      // Menampilkan daftar playlist (index)
    public function index()
    {
        $playlists = Playlist::all();
        return view('playlists.index', compact('playlists',));
    }

    // Menampilkan form untuk membuat playlist baru
    public function create()
    {
        return view('playlists.create');
    }

    // Menyimpan playlist baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Playlist::create([
            'name' => $request->name,
        ]);

        return redirect()->route('playlists.index')->with('success', 'Playlist berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit playlist
    public function edit(Playlist $playlist)
    {
        return view('playlists.edit', compact('playlist'));
    }

    // Memperbarui playlist
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist->update([
            'name' => $request->name,
        ]);

        return redirect()->route('playlists.index')->with('success', 'Playlist berhasil diperbarui!');
    }

    // Menampilkan playlist beserta lagu-lagunya
    public function show(Playlist $playlist)
    {
         // Ambil semua lagu yang belum ada di playlist
    $songs = Song::whereDoesntHave('playlists', function($query) use ($playlist) {
        $query->where('playlist_id', $playlist->id);
    })->get();

    return view('playlists.show', compact('playlist', 'songs'));
    }

    // Menambahkan lagu ke playlist
    public function addSong(Request $request, Playlist $playlist)
    {
        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $playlist->songs()->attach($request->song_id, ['order' => $playlist->songs->count()]);
        return redirect()->route('playlists.show', $playlist)->with('success', 'Lagu berhasil ditambahkan!');
    }

    // Mengubah urutan lagu dalam playlist
    public function updateOrder(Request $request, Playlist $playlist)
    {
        $request->validate([
            'songs' => 'required|array',
            'songs.*' => 'exists:songs,id',
        ]);

        foreach ($request->songs as $index => $songId) {
            $playlist->songs()->updateExistingPivot($songId, ['order' => $index]);
        }

        return redirect()->route('playlists.show', $playlist)->with('success', 'Urutan lagu berhasil diperbarui!');
    }

    // Menghapus lagu dari playlist
    public function removeSong(Playlist $playlist, Song $song)
    {
        $playlist->songs()->detach($song);
        return redirect()->route('playlists.show', $playlist)->with('success', 'Lagu berhasil dihapus!');
    }
    public function destroy(Playlist $playlist)
    {
        // Menghapus playlist beserta lagu-lagu yang terkait jika diperlukan
        $playlist->delete();

        // Redirect ke halaman daftar playlist dengan pesan sukses
        return redirect()->route('playlists.index')->with('success', 'Playlist berhasil dihapus!');
    }
}
