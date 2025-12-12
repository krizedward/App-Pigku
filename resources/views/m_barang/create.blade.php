<!-- Menghubungkan dengan view template master -->
@extends('template.master')

@section('judul', 'Halaman Barang Create')

@section('konten')
<div class="container mt-4">
    <h2>Tambah Barang Baru</h2>
    
    <!-- Formulir untuk membuat barang baru -->
    <form action="#" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Barang" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan Kategori Barang" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Barang" required>
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Jumlah Stok" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/barang" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
