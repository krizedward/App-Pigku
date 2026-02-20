@extends('layouts.app')

@section('title', 'Create Pengguna')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
</div>

@foreach (['success', 'error', 'warning', 'info'] as $msg)
  @if(session($msg))
    <div class="alert alert-{{ $msg == 'error' ? 'danger' : $msg }}">
      {{ session($msg) }}
    </div>
  @endif
@endforeach

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
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
              <label for="username_pengguna">Username Pengguna</label>
              <input type="text" class="form-control" id="username_pengguna" name="username_pengguna"
                placeholder="Masukkan Username Pengguna" required>
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
              <label for="note_pengguna">Catatan Pengguna</label>
              <input type="text" class="form-control" id="note_pengguna" name="note_pengguna"
                placeholder="Masukkan Catatan Pengguna" required>
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