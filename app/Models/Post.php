<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_teman',
        'tanggal_peminjaman',
        'bukti_transaksi',
        'keterangan'
    ];
}
