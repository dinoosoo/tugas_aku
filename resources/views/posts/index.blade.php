@extends('layout/admin')

@section('container')
    <div class="judul-admin">
        <h3>APOTEKER</h3>       
        <hr>
    </div>
    <div class="wrap">
        <div class="card-body">
            <a href="{{ route('posts.create') }}" class="hijau">TAMBAH DATA</a>
            <table border="1">
                <thead>
                    <tr>
                        <th>GAMBAR</th>
                        <th>NAMA OBAT</th>
                        <th>HARGA</th>
                        <th>KELUHAN</th>
                        <th>STOK OBAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>
                                @if ($post->gambar)
                                    <img src="{{ asset('storage/posts/'.$post->gambar) }}" class="rounded" style="width: 150px">
                                @else
                                    Tidak ada gambar.
                                @endif
                            </td>
                            <td>{{ $post->nama_obat }}</td>
                            <td>{{ $post->harga }}</td>
                            <td>{{ $post->keluhan }}</td>
                            <td>{{ $post->stok_obat }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    <a href="{{ route('posts.show', $post->id) }}" class="biru">SHOW</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="kuning">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="merah">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <div class="alert-blomada">
                                    Data obat belum Tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>  
            {{ $posts->links('vendor.pagination.simple-default') }}
        </div>
    </div>
@endsection
