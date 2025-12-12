@extends('layouts.app')

@section('title', 'Master Kategori')

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
        <div class="container">
          
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
          <form action="{{ route('master-kategori.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name_kategori">Nama Kategori</label>
              <input type="text" class="form-control" id="name_kategori" name="name_kategori"
                placeholder="Masukkan Nama Kategori" required>
            </div>

            <div class="form-group">
              <label for="note_kategori">Catatan Kategori</label>
              <input type="text" class="form-control" id="note_kategori" name="note_kategori" placeholder="Masukkan Catatan">
            </div>

            <div class="form-group">
              <label for="is_active">Active?</label>
              <select name="is_active" id="is_active" class="form-control" required>
                <option value="Y">Yes</option>
                <option value="N">No</option>
              </select>
            </div>
            
            <div class="mt-4 mb-4">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('master-payment.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection