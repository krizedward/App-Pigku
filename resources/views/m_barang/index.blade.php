<!-- Menghubungkan dengan view template master -->
@extends('template.master')

<!-- isi bagian judul halaman -->
<!-- cara penulisan isi section yang pendek -->
@section('judul', 'Halaman Barang')

<!-- isi bagian konten -->
<!-- cara penulisan isi section yang panjang -->
@section('konten')
  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($barangs as $barang)
      <tr>
        <td>{{ $barang->id }}</td>
        <td>{{ $barang->nama }}</td>
        <td>{{ $barang->harga }}</td>
        <td>{{ $barang->stok }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection