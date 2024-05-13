@extends('layout/admin')

@section('container')
    <div class="judul-admin">
        <h3>pencatat Hutang Teman</h3>       
        <hr>
    </div>
    <div class="wrap">
        <div class="card-body">
            <a href="{{ route('posts.create') }}" class="hijau">TAMBAH DATA</a>
            <table border="1">
                <thead>
                    <tr>
                        <th>NAMA TEMAN</th>
                        <th>TANGGAL PEMINJAMAN</th>
                        <th>BUKTI TRANSAKI</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            
                                <td>{{ $post->nama_teman }}</td>
                                <td>{{ date('d-m-Y', strtotime($post->tanggal_peminjaman)) }}</td>
                                <td>
                                    @if ($post->bukti_transaksi)
                                        <img src="{{ asset('storage/posts/'.$post->bukti_transaksi) }}" class="rounded" style="width: 150px">
                                    @else
                                        Tidak ada bukti transaksi.
                                    @endif
                                </td>
                                <td>{{ $post->keterangan }}</td>
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
                            <td colspan="5" class="text-center">
                                <div class="alert-blomada">
                                    Data Hutang Teman belum Tersedia.
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