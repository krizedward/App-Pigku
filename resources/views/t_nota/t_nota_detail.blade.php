@extends('layouts.app')

@section('title', 'Nota Detail')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-info btn-icon-split" href="{{ route('nota.filter', [
          'tanggal_awal' => now()->toDateString(),
          'tanggal_akhir' => now()->toDateString()
      ]) }}">
      <span class="icon text-white-100">
        <i class="fas fa-arrow-left"></i>
      </span>
      <!-- <span class="text">Kembali</span> -->
    </a>
    <a class="btn btn-success btn-icon-split" href="{{ route('cashier.index') }}">
      <span class="icon text-white-100">
        <i class="fas fa-cash-register"></i>
      </span>
      <!-- <span class="text">Payment</span> -->
    </a>
  </div>

</div>

<div class="row">
  <div class="col-xl-4 col-lg-4">
    <div class="card shadow mb-4">
      <!-- Header -->
      <!-- <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pesan Tambahan</h6>
      </div> -->
      @if($statusNota == 'paid')
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <!-- start -->
            <li class="nav-item">
              <a class="nav-link active" id="pills-detail3-tab" data-toggle="pill" aria-selected="true"
                href="#pills-detail3" role="tab" aria-controls="pills-detail3">Detail</a>
            </li>
            <!-- end -->
          </ul>
        </div>
      @else
        <div class="card-header d-flex flex-row align-items-center justify-content-between">
          <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <!-- start -->
            <li class="nav-item">
              <a class="nav-link active" id="pills-detail1-tab" data-toggle="pill" aria-selected="true"
                href="#pills-detail1" role="tab" aria-controls="pills-detail1">Tambahan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-detail2-tab" data-toggle="pill" aria-selected="false" href="#pills-detail2"
                role="tab" aria-controls="pills-detail2">Payment</a>
            </li>
            <!-- end -->
          </ul>
        </div>
      @endif

      <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
          @if($statusNota != 'paid')
            <div class="tab-pane fade show active" id="pills-detail1" role="tabpanel" aria-labelledby="pills-detail1-tab">
              <form action="{{ route('nota.update', $nota_id) }}" method="POST" id="orderForm">
                @csrf
                @method('PUT')
                <input type="hidden" class="form-control" value="{{$nota_id}}" name="nota_id" required>
                <input type="hidden" class="form-control" value="Tambahan" name="note_order_detail" required>
                
                <div class="form-group">
                  <label for="menu_id">Pilih Menu</label>
                  <select name="menu_id" id="menu_id" class="form-control">
                    <option value="">-- Pilih Menu --</option>
                    @foreach($menu as $dt)
                    <option value="{{ $dt->id }}">{{ $dt->name_menu }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="qty_menu">Jumlah Order</label>
                  <input type="text" class="form-control" id="qty_menu" name="qty_menu" placeholder="Masukkan Jumlah Order"
                    required>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-2">Simpan</button>
              </form>
            </div>

            <div class="tab-pane fade" id="pills-detail2" role="tabpanel" aria-labelledby="pills-detail2-tab">
              <form action="{{ route('nota.payment', $nota_id) }}" method="POST">
                @csrf
                
                <div class="form-group">
                  <label for="total_shop">Total Belanja</label>
                  <input type="text" class="form-control" name="total_shop" value="{{ $hargaTotal }}">
                  <input type="hidden" name="change_sale" id="total_shop" value="{{ $totalShop }}">
                </div>
                
                <div class="form-group">
                  <label for="paid_sale">Uang Dibayar</label>
                  <input type="text" class="form-control" id="paid_sale" name="paid_sale" placeholder="Masukkan Jumlah Bayar"
                    required>
                </div>

                <div class="form-group">
                  <label for="change_sale">Kembalian</label>
                  <input type="text" class="form-control" id="change_display" readonly>
                  <input type="hidden" name="change_sale" id="change_sale">
                </div>

                <div class="form-group">
                  <label for="payment_id">Pilih Pembayaran</label>
                  <select name="payment_id" id="payment_id" class="form-control">
                    <option value="">-- Pilih Pembayaran --</option>
                    @foreach($payment as $dt)
                    <option value="{{ $dt->id }}">{{ $dt->description_payment }}</option>
                    @endforeach
                  </select>
                </div>

                <!-- <div class="form-group">
                  <label for="qty_menu">Jumlah Order</label>
                  <input type="text" class="form-control" id="qty_menu" name="qty_menu" placeholder="Masukkan Jumlah Order"
                    required>
                </div> -->

                <button type="submit" class="btn btn-success w-100 mt-2">Simpan</button>
              </form>
            </div>
          @endif

          @if($statusNota == 'paid')
            <div class="tab-pane fade show active" id="pills-detail3" role="tabpanel" aria-labelledby="pills-detail3-tab">
              <h6>No Nota</h6>
              <p class="mb-0">
                <strong>{{ $order->code_order }}</strong><br>
                Date : <b>{{ $order->date_order }}</b><br>
                Total Bayar : <b>{{ number_format($order->t_sale->subtotal_sale, 0, ',', '.') }}</b><br>
                Bayar : <b>{{ number_format($order->t_sale->paid_sale, 0, ',', '.') }}</b><br>
                Kembalian : <b>{{ number_format($order->t_sale->change_sale, 0, ',', '.') }}</b><br>
                Metode Pembayaran : <b>{{ $order->t_sale->m_payment->description_payment }}</b>
              </p>
            </div>
          @endif
        </div>

      </div>
      <!-- <div class="card-footer bg-white"></div> -->
    </div>
  </div>

  <div class="col-xl-8 col-lg-8">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Nota Pembelian</h6>
        <!-- <h6 class="m-0 font-weight-bold text-primary">INVOICE</h6> -->
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Showed:</div>
            <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('nota.edit',$datas[0]->code_order) }}">Edit</a>
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
              Kasir : <b>{{ $data->cashier_name }}</b><br>
              Waktu : <b>{{ $data->time_order }}</b><br>
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
                    <th style="text-align: center;vertical-align: middle;">Catatan</th>
                    <th style="text-align: center;vertical-align: middle;">Total</th>
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
                    <td>{{ $data->note_order_detail }}</td>
                    <td>{{ $data->qty_order * $data->price_menu }}</td>
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
                <span>Tax (0%)</span>
                <span>Rp. {{ $taxHarga }}</span>
              </div>
              <div class="d-flex justify-content-between font-weight-bold mt-2">
                <span>Total</span>
                <span>{{ $hargaTotal }}</span>
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

<script>
document.addEventListener("DOMContentLoaded", function () {

    const totalShop = document.getElementById("total_shop");
    const paidSale = document.getElementById("paid_sale");
    const changeDisplay = document.getElementById("change_display");
    const changeSale = document.getElementById("change_sale");

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    paidSale.addEventListener("input", function () {

        let total = parseFloat(totalShop.value) || 0;
        let paid = parseFloat(paidSale.value) || 0;

        let change = paid - total;

        if (change < 0) {
            changeSale.value = "Uang Kurang";
        } else {
            changeSale.value = change;
        }

        // value asli untuk POST
        changeSale.value = change;

        // tampilan rupiah
        changeDisplay.value = formatRupiah(change);

    });

});
</script>

@endsection