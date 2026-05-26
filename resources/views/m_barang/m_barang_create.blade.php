@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">Create @yield('title')</h1>
  </div>
</div>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="container-fluid">
          
        @if ($errors->any())
          <div class="alert alert-danger mt-2 mb-3">
            <strong>Terjadi kesalahan!</strong>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <!-- Formulir untuk membuat barang baru -->
          <form action="{{ route('master-barang.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name_barang">Nama Barang</label>
              <input type="text" class="form-control" id="name_barang" name="name_barang"
                placeholder="Masukkan Nama Barang" required>
            </div>

            <div class="form-group">
              <label for="brand_barang">Brand Barang</label>
              <input type="text" class="form-control" id="brand_barang" name="brand_barang"
                placeholder="Masukkan Brand Barang">
            </div>

            <div class="form-group">
              <label for="satuan_id">Pilih Satuan</label>
              <select name="satuan_id" id="satuan_id" class="form-control">
                <option value="">-- Pilih Satuan --</option>
                @foreach($satuan as $dt)
                <option value="{{ $dt->id }}">{{ $dt->name_satuan }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="volume_barang">Volume Barang</label>
              <input type="number" class="form-control" id="volume_barang" name="volume_barang"
                placeholder="Masukkan Volume Barang" required>
            </div>

            <div class="form-group">
              <label for="note_barang">Catatan Barang</label>
              <input type="text" class="form-control" id="note_barang" name="note_barang" placeholder="Masukkan Catatan">
            </div>

            <div class="form-group">
              <label for="is_active">Status Aktif <span class="text-danger">*</span></label><br>
              <label class="radio-inline mr-4">
                <input type="radio" name="is_active" value="Y"> Aktif
              </label>
              <label class="radio-inline">
                <input type="radio" name="is_active" value="N"> Tidak Aktif
              </label>
            </div>
            
            <div class="mt-4 mb-4">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('master-barang.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection