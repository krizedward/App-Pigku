@extends('layouts.app')

@section('title', 'Nota Detail')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">Edit @yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-info btn-icon-split" href="{{ route('nota.detail', $order->code_order) }}">
      <span class="icon text-white-100">
        <i class="fas fa-arrow-left"></i>
      </span>
      <span class="text">Kembali</span>
    </a>
  </div>

</div>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">{{ $order->code_order }}</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="table-responsive my-2">
          <table class="table table-striped table-bordered mb-0" id="event-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="text-align: center;vertical-align: middle;">No</th>
                <th style="text-align: center;vertical-align: middle;">Nama</th>
                <th style="text-align: center;vertical-align: middle;">Jumlah</th>
                <th style="text-align: center;vertical-align: middle;">Satuan</th>
                <th style="text-align: center;vertical-align: middle;">Harga</th>
                <th style="text-align: center;vertical-align: middle;">Catatan</th>
                <th style="text-align: center;vertical-align: middle;">Total</th>
                <th style="width: 0;text-align: center;">Aksi</th>
              </tr>
            </thead>

            <tbody id="event-table-body">
              @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $data->name_menu }}</td>
                  <td>{{ $data->qty_order }}</td>
                  <td>{{ $data->unit_menu }}</td>
                  <td>{{ $data->price_menu }}</td>
                  <td>{{ $data->note_order_detail }}</td>
                  <td>{{ $data->qty_order * $data->price_menu }}</td>
                  <td colspan="2">
                    <div class='d-flex'>
                      <form action="{{ route('nota.destroy', $data->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class='btn btn-sm btn-danger'><i
                            class='fa fa-trash'></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-2">Showing page <a class="badge badge-primary" id="current-paging"></a></div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection