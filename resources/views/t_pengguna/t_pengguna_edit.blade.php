@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="container">
          <form action="{{ route('pengguna.store') }}" method="POST" id="orderForm">
            @csrf
            <div class="form-group">
              <label for="name_pengguna">Nama Pengguna</label>
              <input type="text" class="form-control" id="name_pengguna" name="name_pengguna"
                placeholder="Masukkan Nama Pengguna" required>
            </div>

            <div class="form-group">
              <label for="email_pengguna">Email Pengguna</label>
              <input type="email" class="form-control" id="email_pengguna" name="email_pengguna"
                placeholder="Masukkan Email Pengguna" required>
            </div>
            
            <div class="form-group">
              <label for="jenis_pengguna">Jenis Pengguna</label>
              <select name="jenis_pengguna" id="jenis_pengguna" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($data as $dt)
                  <option value="{{ $dt->id }}">{{ $dt->name_role }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="is_active">Active?</label>
              <select name="is_active" id="is_active" class="form-control" required>
                <option value="Y">Yes</option>
                <option value="N">No</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/pengguna" class="btn btn-secondary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection