@extends('layouts.app')

@section('title', 'Sale')

@section('content')
<!-- <p>memilih metode pembayaran apa yang harus dibuat?</p> -->
<!-- <p>Membuat tabel dulu seperti AIM SIM baru nanti update di perbaiki pelan pelan.</p> -->

<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-primary btn-icon-split" href="{{ route('sale.create') }}">
      <span class="icon text-white-100">
        <i class="fas fa-plus"></i>
      </span>
      <span class="text">Add</span>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data Payment</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="table-responsive my-2">
          <table class="table table-striped table-bordered mb-0" id="event-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="text-align: center;vertical-align: middle;">No</th>
                <th style="text-align: center;vertical-align: middle;">Nomor Nota</th>
                <th style="text-align: center;vertical-align: middle;">Metode</th>
                <th style="text-align: center;vertical-align: middle;">Subtotal</th>
                <th style="text-align: center;vertical-align: middle;">Pajak</th>
                <th style="text-align: center;vertical-align: middle;">Diskon</th>
                <th style="text-align: center;vertical-align: middle;">Total</th>
                <th style="text-align: center;vertical-align: middle;">Bayar</th>
                <th style="text-align: center;vertical-align: middle;">Kembalian</th>
                <th style="text-align: center;vertical-align: middle;">Status Nota</th>
                <th style="text-align: center;vertical-align: middle;">Catatan Nota</th>
                <th style="width: 0;text-align: center;">Aksi</th>
              </tr>
            </thead>

            <tbody id="event-table-body">
              @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $data->t_order->code_order }}</td>
                  <td>{{ $data->m_payment->description_payment }}</td>
                  <td>{{ $data->subtotal_sale }}</td>
                  <td>{{ $data->tax_sale }}</td>
                  <td>{{ $data->discount_sale }}</td>
                  <td>{{ $data->total_sale }}</td>
                  <td>{{ $data->paid_sale }}</td>
                  <td>{{ $data->change_sale }}</td>
                  <td>{{ $data->status_sale }}</td>
                  <td>{{ $data->note_sale }}</td>
                  <td colspan="2">
                    <div class='d-flex'>
                      <a class='btn btn-sm btn-warning mr-2' href="{{ route('sale.edit', $data->id) }}"><i class='fa fa-edit'></i></a>
                      <form action="{{ route('sale.destroy', $data->id) }}" method="POST" style="display:inline;">
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
          <div class="col-auto ms-auto">
            <div class="btn-group mt-2 mb-2 mb-sm-0" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-primary" id="previous-page-event-table">Previous</button>
              <button type="button" class="btn btn-primary" id="next-page-event-table">Next</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection