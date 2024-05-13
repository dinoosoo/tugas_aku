@extends('layout/main')

@section('container')
    <header>
        <h1>Selamat Datang</h1>
        <h3>di Website Cunsul</h3>
        <div class="subheader">
            <h4>Website pencatat hutang teman</h4>
            <h2>By Mustofa</h2>
        </div>

    </header>

    <div class="row">
        @forelse ($posts as $post)
        <?php
            $harga = $post->pr
        ?>
        <div class="card">
            <a href="{{ route('posts.show', $post->id) }}">
            <div class="image">
                <img width="250px" height="200px" src="{{ asset('storage/posts/'.$post->bukti_transaksi) }}" alt="Wallpaper">
            </div>

            <div class="description">
                <p>{{ $post->keterangan }}</p>
                
            </div>
            </a>
        </div>
        @empty
        <div class="alert alert-danger">
            data hutang_teman Tidak Tersedia.
        </div>
        @endforelse

    </div>
        {{ $posts->links('vendor.pagination.simple-default') }}

@endsection