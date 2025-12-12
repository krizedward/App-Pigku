@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">Create @yield('title')</h1>
  </div>
</div>

<div class="row">
  <div class="col-xl-12 col-lg-12 mb-4">
    <div class="card shadow">
      <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <!-- start -->
          <li class="nav-item">
            <a class="nav-link active" id="pills-detail1-tab" data-toggle="pill" aria-selected="true"
              href="#pills-detail1" role="tab" aria-controls="pills-detail1">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-detail2-tab" data-toggle="pill" aria-selected="false" href="#pills-detail2"
              role="tab" aria-controls="pills-detail2">Paket</a>
          </li>
          <!-- end -->
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="pills-tabContent">

          <div class="tab-pane fade show active" id="pills-detail1" role="tabpanel" aria-labelledby="pills-detail1-tab">
            <div class="table-responsive my-2">
              <div class="container">
                <!-- Formulir untuk membuat barang baru -->
                <form action="{{ route('menu.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="name_menu">Nama Menu</label>
                    <input type="text" class="form-control" id="name_menu" name="name_menu"
                      placeholder="Masukkan Nama Menu" required>
                  </div>

                  <div class="form-group">
                    <label for="price_menu">Harga Menu</label>
                    <input type="text" class="form-control" id="price_menu" name="price_menu"
                      placeholder="Masukkan Harga Menu" required>
                  </div>

                  <div class="form-group">
                    <label for="kategori_id">Pilih Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                      <option value="">-- Pilih Kategori --</option>
                      @foreach($kategori as $k)
                      <option value="{{ $k->id }}">{{ $k->name_kategori }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="note_menu">Catatan Menu</label>
                    <input type="text" class="form-control" id="note_menu" name="note_menu"
                      placeholder="Masukkan Catatan">
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
                    <a href="/menu" class="btn btn-secondary">Kembali</a>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="pills-detail2" role="tabpanel" aria-labelledby="pills-detail2-tab">
            <div class="table-responsive my-2">
              <div class="container">
                <!-- Formulir untuk membuat barang baru -->
                <form action="{{ route('tempmenudetail.store') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="paket_id">Pilih Paket</label>
                    <select name="paket_id" id="paket_id" class="form-control">
                      <option value="">-- Pilih Paket --</option>
                      @foreach($paket as $data)
                      <option value="{{ $data->id }}">{{ $data->t_menu->name_menu }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="menu_id">Pilih Menu</label>
                    <select name="menu_id" id="menu_id" class="form-control">
                      <option value="">-- Pilih Menu --</option>
                      @foreach($menu as $data)
                      <option value="{{ $data->id }}">{{ $data->name_menu }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="qty_menu">Jumlah Menu</label>
                    <input type="text" class="form-control" id="qty_menu" name="qty_menu"
                      placeholder="Masukkan Jumlah Menu" required>
                  </div>

                  <div class="mt-4 mb-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="/menu" class="btn btn-secondary">Kembali</a>
                  </div>
                </form>

                <table border="1" class="table table-bordered table-striped mt-5">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Jumlah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($temp_menudetail as $index => $menudetail)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>
                        {{ $menudetail->description_expense ?? '-' }}
                        <input type="hidden" name="menudetail[{{ $index }}][description_expense]"
                          value="{{ $menudetail->description_expense }}">
                      </td>
                      <td>
                        {{ $menudetail->description_expense ?? '-' }}
                        <input type="hidden" name="menudetail[{{ $index }}][description_expense]"
                          value="{{ $menudetail->description_expense }}">
                      </td>
                      <td>
                        <button type="submit" form="delete-form-{{ $menudetail->id }}" class="btn btn-sm btn-danger"
                          onclick="return confirm('Hapus menudetail ini?')">
                          Hapus
                        </button>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4" class="text-center">Belum ada data paket</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- end -->
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection