@extends('layouts.app')

@section('title', 'Master Satuan')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">Edit @yield('title')</h1>
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
          <form action="{{ route('master-satuan.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="name_satuan">Nama Satuan</label>
              <input type="text" class="form-control" id="name_satuan" name="name_satuan"
                value="{{ old('name_satuan', $data->name_satuan) }}"
                placeholder="Masukkan Nama Satuan" 
                required>
            </div>

            <div class="form-group">
              <label for="symbol_satuan">Simbol Satuan</label>
              <input type="text" class="form-control" id="symbol_satuan" name="symbol_satuan"
                value="{{ old('symbol_satuan', $data->symbol_satuan) }}"
                placeholder="Masukkan Simbol Satuan" 
                required>
            </div>

            <div class="form-group">
              <label for="note_satuan">Catatan Satuan</label>
              <textarea id="note_satuan"
                  name="note_satuan"
                  rows="3"
                  class="form-control"
                  placeholder="Keterangan tambahan …">{{ old('note_satuan', $data->note_satuan) }}</textarea> 
            </div>

            {{-- is_active --}}
            <div class="form-group">
                <label>Status Aktif <span class="text-danger">*</span></label><br>
                <label class="radio-inline mr-4">
                    <input type="radio" name="is_active" value="Y"
                           {{ old('is_active', $data->is_active) == 'Y' ? 'checked' : '' }}> Aktif
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_active" value="N"
                           {{ old('is_active', $data->is_active) == 'N' ? 'checked' : '' }}> Tidak Aktif
                </label>
            </div>
            
            <div class="mt-4 mb-4">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('master-satuan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection