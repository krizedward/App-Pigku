@extends('layouts.app')

@section('title', 'Nota Detail')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-info btn-icon-split" href="{{ url()->previous() }}">
      <span class="icon text-white-100">
        <i class="fas fa-arrow-left"></i>
      </span>
      <span class="text">Kembali</span>
    </a>
  </div>

</div>

<div class="row">
  <div class="col-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 flex-row align-items-center justify-content-between">
        <!-- HEADER -->
        <div class="row align-items-center">
          <div class="col-md-6">
            <div class="invoice-logo">Pigku Pigku</div>
          </div>
          <div class="col-md-6 text-md-right text-left mt-3 mt-md-0">
            <span class="badge-invoice">INVOICE</span>
          </div>
        </div>
      </div>
      <div class="card-body p-5">

        <!-- FROM & BILL TO -->
        <div class="row mb-4">
          <div class="col-md-6 mb-3 mb-md-0">
            @foreach ($datas as $index => $data)
            <h6>No Nota</h6>
            <p class="mb-0">
              <strong>{{ $data->code_order }}</strong><br>
              Date : <b>{{ $data->date_order }}</b><br>
              Total Item : <b>{{ $data->total_item }}</b><br>
              Kasir : -<br>
              Waktu : -<br>
              Tipe Orderan : (Take Way/Dine In)
            </p>
            @endforeach
          </div>
        </div>

        <!-- TABLE -->
        <div class="row mb-4">
          <div class="col-12">
            <div class="table-responsive my-2">
              <table class="table table-striped table-bordered mb-0" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="text-align: center;vertical-align: middle;">No</th>
                    <th style="text-align: center;vertical-align: middle;">Nama</th>
                    <th style="text-align: center;vertical-align: middle;">Jumlah</th>
                    <th style="text-align: center;vertical-align: middle;">Satuan</th>
                    <th style="text-align: center;vertical-align: middle;">Harga</th>
                  </tr>
                </thead>
                <tbody id="event-table-body">
                  @foreach ($dataBaru as $index => $data)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->name_menu }}</td>
                    <td>{{ $data->qty_order }}</td>
                    <td>{{ $data->unit_menu }}</td>
                    <td>{{ $data->price_menu }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- TOTALS -->
        <div class="row justify-content-end mb-4">
          <div class="col-md-5 col-lg-4">
            <div class="totals-inner">
              <div class="d-flex justify-content-between">
                <span>Subtotal</span>
                <span>Rp. {{ $hargaSubtotal }}</span>
              </div>
              <div class="d-flex justify-content-between">
                <span>Tax (10%)</span>
                <span>Rp. {{ $taxHarga }}</span>
              </div>
              <div class="d-flex justify-content-between font-weight-bold mt-2">
                <span>Total</span>
                <span>Rp. {{ $hargaTotal }}</span>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="card-footer mt-2">
        <!-- FOOTER -->
        <div class="row">
          <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
            <p class="mb-1 font-weight-bold">Terima kasih telah berkunjung 🙏</p>
            <p class="mb-0">Kami tunggu kedatangan Anda kembali.</p>
          </div>
          <div class="col-md-6 text-center text-md-right">
            <p class="mb-1">Pembayaran : Tunai / Transfer / QRIS</p>
            <p class="mb-0">Include Tax & Service Charge</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection