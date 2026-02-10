@extends('layouts.app')

@section('title', 'Kasir')

@section('content')
<style>
  .menu-list .card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .menu-list .card:hover {
    transform: translateY(-3px);
    /* box-shadow: 0 8px 20px rgba(0,0,0,.1); */
  }

  /* Horizontal scroll */
  .nav-scroll {
    flex-wrap: nowrap;
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
    gap: 8px;
  }

  .nav-scroll::-webkit-scrollbar {
    display: none;
  }

  .nav-scroll .nav-item {
    flex: 0 0 auto;
  }

  .nav-scroll .nav-link {
    white-space: nowrap;
  }
</style>
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
        <i class="fas fa-file-invoice"></i>
      </span>
      <span class="text">Nota</span>
    </a>
  </div>
</div>

<div class="row">
  <!-- kanan -->
  <div class="col-xl-4 col-lg-4">
    <div class="card shadow mb-4">
      <!-- Header -->
      <div class="card-header d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Pesan Aktif</h6>
        <form action="{{ route('temporder.reset') }}" method="POST"
          onsubmit="return confirm('Yakin reset semua pesanan?')">
          @csrf
          <input type="hidden" name="type_form" value="kasir">
          <button type="submit" class="btn btn-sm btn-danger">
            Reset
          </button>
        </form>
      </div>

      <!-- Body -->
      <div class="card-body min-vh-25">

        {{-- Error --}}
        @if ($errors->any())
        <div class="alert alert-danger">
          <strong>Terjadi kesalahan!</strong>
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form id="order-form" action="{{ route('cashier.store') }}" method="POST">
          @csrf
          <input type="hidden" name="type_form" value="cashier">
          <input type="hidden" name="date_form" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

          <div class="table-responsive">
            <table class="table table-sm table-bordered table-striped align-middle">
              <thead class="table-light">
                <tr>
                  <th>Menu</th>
                  <th>Total</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($temp_order as $index => $order)
                <tr class="align-middle">

                  <input type="hidden" name="orders[{{ $index }}][date_order]"
                    value="{{ \Carbon\Carbon::parse($order->date_order)->format('Y-m-d') }}">

                  {{-- Kolom Gambar --}}
                  <td class="align-middle">
                    <!-- <img src="https://placehold.co/50x50" class="img-fluid rounded mx-auto d-block" alt="Menu"> -->
                    <div class="d-flex justify-content-left align-items-center">
                      {{ $order->t_menu->name_menu ?? '-' }}
                    </div>
                    <input type="hidden" name="orders[{{ $index }}][menu_id]" value="{{ $order->menu_id }}">
                  </td>

                  {{-- Kolom Qty & Harga --}}
                  <td class="align-middle">
                    <div class="d-flex justify-content-left align-items-center">
                      <strong>{{ $order->qty_menu }}</strong> ×
                      <span>Rp{{ number_format($order->t_menu->price_menu, 0, ',', '.') }}</span>
                    </div>
                    <input type="hidden" name="orders[{{ $index }}][qty_order]" value="{{ $order->qty_menu }}">
                    <input type="hidden" name="orders[{{ $index }}][price_menu]"
                      value="{{ $order->t_menu->price_menu }}">
                    <input type="hidden" name="orders[{{ $index }}][subtotal_price]"
                      value="{{ $order->subtotal_price }}">
                  </td>

                  {{-- Kolom Aksi --}}
                  <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center">
                      <button type="submit" form="delete-form-{{ $order->id }}" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Hapus order ini?')">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>
                  </td>

                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center text-muted">
                    Belum ada data order
                  </td>
                </tr>
                @endforelse

              </tbody>
            </table>
          </div>
        </form>

        {{-- Form hapus --}}
        @foreach($temp_order as $order)
        <form id="delete-form-{{ $order->id }}" action="{{ route('temporder.destroy', $order->id) }}" method="POST"
          class="d-none">
          @csrf
          @method('DELETE')
        </form>
        @endforeach
      </div>

      <!-- Footer -->
      <div class="card-footer bg-white">
        <button type="submit" form="order-form" class="btn btn-success w-100">
          Simpan Semua Order
        </button>
      </div>

    </div>
  </div>

  <!-- kiri -->
  <div class="col-xl-8 col-lg-8">
    <div class="card shadow mb-4">
      <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <ul class="nav nav-pills nav-scroll" id="pills-tab" role="tablist">
          <!-- start -->
          <li class="nav-item">
            <a class="nav-link active" id="pills-detail1-tab" data-toggle="pill" aria-selected="true" data-tab="makanan"
              href="#pills-detail1" role="tab" aria-controls="pills-detail1">Makanan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-detail2-tab" data-toggle="pill" aria-selected="false" href="#pills-detail2"
              data-tab="minuman" role="tab" aria-controls="pills-detail2">Minuman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-detail3-tab" data-toggle="pill" aria-selected="false" href="#pills-detail3"
              data-tab="paket" role="tab" aria-controls="pills-detail3">Paket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-detail4-tab" data-toggle="pill" aria-selected="false" href="#pills-detail4"
              data-tab="additional" role="tab" aria-controls="pills-detail4">Additional</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-detail5-tab" data-toggle="pill" aria-selected="false" href="#pills-detail5"
              data-tab="promo" role="tab" aria-controls="pills-detail5">Promo</a>
          </li>
          <!-- end -->
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
          <!-- pills-1 -->
          <div class="tab-pane fade show active" id="pills-detail1" role="tabpanel" aria-labelledby="pills-detail1-tab">
            <!-- start -->
            <div class="row">
              @foreach ($food_product as $data)
              <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 12px;">
                  <div class="card-body p-3 d-flex flex-column">

                    <div class="media">
                      <img src="https://placehold.co/100x100" 
                          class="mr-3 rounded" 
                          style="object-fit: cover;" 
                          alt="{{ $data->name_menu }}">

                      <div class="media-body">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h6 class="mb-1 font-weight-bold text-dark">{{ $data->name_menu }}</h6>
                            <p class="text-primary font-weight-bold mb-0">
                              Rp {{ number_format($data->price_menu, 0, ',', '.') }}
                            </p>
                          </div>
                        </div>

                        <div class="d-none d-md-block mt-3">
                          @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Tambah'])
                        </div>
                      </div>
                    </div>

                    <div class="d-block d-md-none mt-3 mt-auto">
                      @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Add'])
                    </div>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- end -->

          </div>
          <!-- pills-2 -->
          <div class="tab-pane fade" id="pills-detail2" role="tabpanel" aria-labelledby="pills-detail2-tab">
            <!-- start -->
            <div class="row">
              @foreach ($drink_product as $index => $data)
              <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 12px;">
                  <div class="card-body p-3 d-flex flex-column">

                    <div class="media">
                      <img src="https://placehold.co/100x100" 
                          class="mr-3 rounded" 
                          style="object-fit: cover;" 
                          alt="{{ $data->name_menu }}">

                      <div class="media-body">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h6 class="mb-1 font-weight-bold text-dark">{{ $data->name_menu }}</h6>
                            <p class="text-primary font-weight-bold mb-0">
                              Rp {{ number_format($data->price_menu, 0, ',', '.') }}
                            </p>
                          </div>
                        </div>

                        <div class="d-none d-md-block mt-3">
                          @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Tambah'])
                        </div>
                      </div>
                    </div>

                    <div class="d-block d-md-none mt-3 mt-auto">
                      @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Add'])
                    </div>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- end -->

          </div>
          <!-- pills-3 -->
          <div class="tab-pane fade" id="pills-detail3" role="tabpanel" aria-labelledby="pills-detail3-tab">
            <!-- start -->
            <div class="row">
              @foreach ($paket_product as $index => $data)
              <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 12px;">
                  <div class="card-body p-3 d-flex flex-column">

                    <div class="media">
                      <img src="https://placehold.co/100x100" 
                          class="mr-3 rounded" 
                          style="object-fit: cover;" 
                          alt="{{ $data->name_menu }}">

                      <div class="media-body">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h6 class="mb-1 font-weight-bold text-dark">{{ $data->name_menu }}</h6>
                            <p class="text-primary font-weight-bold mb-0">
                              Rp {{ number_format($data->price_menu, 0, ',', '.') }}
                            </p>
                          </div>
                        </div>

                        <div class="d-none d-md-block mt-3">
                          @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Tambah'])
                        </div>
                      </div>
                    </div>

                    <div class="d-block d-md-none mt-3 mt-auto">
                      @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Add'])
                    </div>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- end -->

          </div>
          <!-- pills-4-->
          <div class="tab-pane fade" id="pills-detail4" role="tabpanel" aria-labelledby="pills-detail4-tab">
            <!-- start -->
            <div class="row">
              @foreach ($additional_product as $index => $data)
              <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 12px;">
                  <div class="card-body p-3 d-flex flex-column">

                    <div class="media">
                      <img src="https://placehold.co/100x100" 
                          class="mr-3 rounded" 
                          style="object-fit: cover;" 
                          alt="{{ $data->name_menu }}">

                      <div class="media-body">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h6 class="mb-1 font-weight-bold text-dark">{{ $data->name_menu }}</h6>
                            <p class="text-primary font-weight-bold mb-0">
                              Rp {{ number_format($data->price_menu, 0, ',', '.') }}
                            </p>
                          </div>
                        </div>

                        <div class="d-none d-md-block mt-3">
                          @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Tambah'])
                        </div>
                      </div>
                    </div>

                    <div class="d-block d-md-none mt-3 mt-auto">
                      @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Add'])
                    </div>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- end -->

          </div>
          <!-- pills-5-->
          <div class="tab-pane fade" id="pills-detail5" role="tabpanel" aria-labelledby="pills-detail5-tab">
            <!-- start -->
            <div class="row">
              @foreach ($promo_product as $index => $data)
              <div class="col-12 col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0" style="border-radius: 12px;">
                  <div class="card-body p-3 d-flex flex-column">

                    <div class="media">
                      <img src="https://placehold.co/100x100" 
                          class="mr-3 rounded" 
                          style="object-fit: cover;" 
                          alt="{{ $data->name_menu }}">

                      <div class="media-body">
                        <div class="d-flex justify-content-between align-items-start">
                          <div>
                            <h6 class="mb-1 font-weight-bold text-dark">{{ $data->name_menu }}</h6>
                            <p class="text-primary font-weight-bold mb-0">
                              Rp {{ number_format($data->price_menu, 0, ',', '.') }}
                            </p>
                          </div>
                        </div>

                        <div class="d-none d-md-block mt-3">
                          @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Tambah'])
                        </div>
                      </div>
                    </div>

                    <div class="d-block d-md-none mt-3 mt-auto">
                      @include('t_cashier.form_order', ['data' => $data, 'btnText' => 'Add'])
                    </div>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <!-- end -->

          </div>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="modal fade" id="modal-order" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulir untuk membuat barang baru -->
        <form id="temporder-form" action="{{ route('temporder.store') }}" method="POST" id="orderForm">
          @csrf
          <div class="form-group">
            <label for="date_order">Tanggal Order</label>
            <input type="date" class="form-control" id="date_order" name="date_order"
              value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
          </div>

          <div class="form-group">
            <label for="menu_id">Menu</label>
            <!-- <input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Masukkan Menu" readonly> -->
            <input type="hidden" name="menu_id" id="menu_id">
            <input type="text" class="form-control" id="menu_name" readonly>
          </div>

          <div class="form-group">
            <label for="qty_menu">Jumlah Order</label>
            <input type="number" min="1" class="form-control" id="qty_menu" name="qty_menu"
              placeholder="Masukkan Jumlah Order" required>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button form="temporder-form" type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('#pills-tab .nav-link').forEach(tab => {
    tab.addEventListener('click', function() {
      localStorage.setItem('activeTabKasir', this.dataset.tab);
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const activeTab = localStorage.getItem('activeTabKasir');
    if (activeTab) {
      const tab = document.querySelector(
        `#pills-tab .nav-link[data-tab="${activeTab}"]`
      );
      if (tab) {
        tab.click(); // trigger bootstrap pill
      }
    }
  });
</script>
@endsection