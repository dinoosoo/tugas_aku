@extends('layout/main')

@section('container')
    <header>
        <h1>Selamat Datang</h1>
        <h3>di Website Cunsul</h3>
        <div class="subheader">
            <h4>Website APOTEKER</h4>
            <h2>By Ridha</h2>
        </div>
    </header>

    <div class="row">
        @forelse ($posts as $post)
        <div class="card">
            <a href="{{ route('posts.show', $post->id) }}">
                <div class="image">
                    <img width="250px" height="200px" src="{{ asset('storage/posts/'.$post->gambar) }}" alt="Gambar Obat">
                </div>

                <div class="description">
                    <h5>{{ $post->nama_obat }}</h5>
                    <p>Harga: {{ $post->harga }}</p>
                    <p>Keluhan: {{ $post->keluhan }}</p>
                    <p>Stok Obat: {{ $post->stok_obat }}</p>
                </div>
            </a>
        </div>
        @empty
        <div class="alert alert-danger">
            Data obat belum tersedia.
        </div>
        @endforelse
    </div>

    {{ $posts->links('vendor.pagination.simple-default') }}

@endsection
