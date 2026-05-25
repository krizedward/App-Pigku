@extends('layouts.app')

@section('title', 'Master Barang')

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
          <form action="{{ route('master-barang.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
              <label for="name_barang">Nama Barang</label>
              <input type="text" class="form-control" id="name_barang" name="name_barang"
                placeholder="Masukkan Nama Barang" 
                value="{{ old('name_barang', $data->name_barang) }}"
                required>
            </div>

            <div class="form-group">
              <label for="brand_barang">Brand Barang</label>
              <input type="text" class="form-control" id="brand_barang" name="brand_barang"
                value="{{ old('brand_barang', $data->brand_barang) }}"
                placeholder="Masukkan Brand Barang">
            </div>

            <div class="form-group">
              <label for="satuan_id">Pilih Satuan</label>
              <input type="hidden" class="form-control"
                value="{{ old('satuan_id', $data->satuan_id) }}"
                placeholder="Masukkan Brand Barang">
              <select name="satuan_id" id="satuan_id" class="form-control">
                <option value="">-- Pilih Satuan --</option>
                @foreach($satuan as $dt)
                <option value="{{ $dt->id }}">{{ $dt->name_satuan }}</option>
                @endforeach

                @foreach($satuan as $dt)

                    <option value="{{ $dt->id }}"
                        {{ old('satuan_id', $data->satuan_id ?? '') == $dt->id ? 'selected' : '' }}>

                        {{ $dt->name_satuan }}

                    </option>

                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="volume_barang">Volume Barang</label>
              <input type="number" class="form-control" id="volume_barang" name="volume_barang"
                value="{{ old('volume_barang', $data->volume_barang) }}"
                placeholder="Masukkan Volume Barang" required>
            </div>

            <div class="form-group">
              <label for="note_barang">Catatan Barang</label>
              <textarea id="note_barang"
                name="note_barang"
                rows="3"
                class="form-control"
                placeholder="Keterangan tambahan …">{{ old('note_barang', $data->note_barang) }}</textarea>
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
              <a href="{{ route('master-barang.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection