@extends('layouts.app')

@section('title', 'Akses')

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
          <form action="{{ route('akses.store') }}" method="POST">
            @csrf

            <div class="form-group">
              <label for="bmenu_id">Pilih Menu</label>
              <select name="bmenu_id" id="bmenu_id" class="form-control">
                <option value="">-- Pilih Menu --</option>
                @foreach($menus as $dt)
                <option value="{{ $dt->id }}">{{ $dt->menu_name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="trole_id">Pilih Pengguna</label>
              <select name="trole_id" id="trole_id" class="form-control">
                <option value="">-- Pilih Pengguna --</option>
                @foreach($roles as $dt)
                <option value="{{ $dt->id }}">{{ $dt->t_pengguna->fullname_pengguna }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="note_b_role_menu">Catatan Menu</label>
              <input type="text" class="form-control" id="note_b_role_menu" name="note_b_role_menu" placeholder="Masukkan Catatan">
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