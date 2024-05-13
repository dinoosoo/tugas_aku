<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(): View
    {
        // Mengambil data post
        $posts = Post::latest()->paginate(4);

        // Mengembalikan view dengan data post
        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'nama_teman' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'bukti_transaksi' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable',
        ]);

        // Upload bukti transaksi
        $buktiTransaksi = $request->file('bukti_transaksi');
        $buktiTransaksi->storeAs('public/posts', $buktiTransaksi->hashName());

        // Membuat data post baru
        Post::create([
            'nama_teman' => $request->nama_teman,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'bukti_transaksi' => $buktiTransaksi->hashName(),
            'keterangan' => $request->keterangan,
        ]);

        // Redirect ke index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        // Mengambil data post berdasarkan ID
        $post = Post::findOrFail($id);

        // Mengembalikan view dengan data post
        return view('posts.show', compact('post'));
    }

    public function edit(string $id): View
    {
        // Mengambil data post berdasarkan ID
        $post = Post::findOrFail($id);

        // Mengembalikan view dengan data post untuk proses edit
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $this->validate($request, [
            'nama_teman' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'keterangan' => 'nullable',
        ]);

        // Mengambil data post berdasarkan ID
        $post = Post::findOrFail($id);

        // Jika terdapat bukti transaksi baru yang diunggah
        if ($request->hasFile('bukti_transaksi')) {
            // Upload bukti transaksi baru
            $buktiTransaksi = $request->file('bukti_transaksi');
            $buktiTransaksi->storeAs('public/posts', $buktiTransaksi->hashName());

            // Hapus bukti transaksi lama
            Storage::delete('public/posts/' . $post->bukti_transaksi);

            // Update data post dengan bukti transaksi baru
            $post->update([
                'nama_teman' => $request->nama_teman,
                'tanggal_peminjaman' => $request->tanggal_peminjaman,
                'bukti_transaksi' => $buktiTransaksi->hashName(),
                'keterangan' => $request->keterangan,
            ]);
        } else {
            // Update data post tanpa mengubah bukti transaksi
            $post->update([
                'nama_teman' => $request->nama_teman,
                'tanggal_peminjaman' => $request->tanggal_peminjaman,
                'keterangan' => $request->keterangan,
            ]);
        }

        // Redirect ke index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        // Mengambil data post berdasarkan ID
        $post = Post::findOrFail($id);

        // Hapus bukti transaksi
        Storage::delete('public/posts/' . $post->bukti_transaksi);

        // Hapus data post
        $post->delete();

        // Redirect ke index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
