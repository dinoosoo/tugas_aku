<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Hutang Teman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Teman</label>
                                <input type="text" class="form-control @error('nama_teman') is-invalid @enderror" name="nama_teman" value="{{ old('nama_teman', $post->nama_teman) }}" placeholder="Masukkan Nama Teman">
                            
                                <!-- error message untuk nama_teman -->
                                @error('nama_teman')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Peminjaman</label>
                                <input type="date" class="form-control @error('tanggal_peminjaman') is-invalid @enderror" name="tanggal_peminjaman" value="{{ old('tanggal_peminjaman', $post->tanggal_peminjaman) }}">
                            
                                <!-- error message untuk tanggal_peminjaman -->
                                @error('tanggal_peminjaman')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Bukti Transaksi</label>
                                <input type="file" class="form-control @error('bukti_transaksi') is-invalid @enderror" name="bukti_transaksi">
                            
                                <!-- error message untuk bukti_transaksi -->
                                @error('bukti_transaksi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="5" placeholder="Masukkan Keterangan">{{ old('keterangan', $post->keterangan) }}</textarea>
                            
                                <!-- error message untuk keterangan -->
                                @error('keterangan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
</body>
</html>
