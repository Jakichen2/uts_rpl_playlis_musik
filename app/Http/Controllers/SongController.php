<?php

namespace App\Http\Controllers;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{   
    public function index(){
        $songs =Song::all();
        return view('songs.index', compact('songs'));
    }
    public function destroy(Song $song)
{
    // Menghapus lagu dari database
    $song->delete();

    // Redirect ke halaman daftar lagu dengan pesan sukses
    return redirect()->route('songs.index')->with('success', 'Lagu berhasil dihapus!');
}

     // Menampilkan halaman form untuk menambah lagu baru
     public function create()
     {
         return view('songs.create');
     }
 
     // Menyimpan lagu baru ke database
     public function store(Request $request)
     {
         // Validasi input
         $request->validate([
             'title' => 'required|string|max:255',
             'artist' => 'required|string|max:255',
             'duration' => 'required|string|max:10',
         ]);
 
         // Menyimpan data lagu ke dalam tabel songs
         Song::create([
             'title' => $request->title,
             'artist' => $request->artist,
             'duration' => $request->duration,
         ]);
 
         // Redirect ke halaman dengan pesan sukses
         return redirect()->route('songs.create')->with('success', 'Lagu berhasil ditambahkan!');
     }
}
