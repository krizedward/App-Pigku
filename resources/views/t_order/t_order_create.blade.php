@extends('layouts.app')

@section('title', 'Order')

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
          <!-- Formulir untuk membuat barang baru -->
          <form action="{{ route('temporder.store') }}" method="POST" id="orderForm">
            @csrf
            <div class="form-group">
              <label for="date_order">Tanggal Order</label>
              <input type="date" class="form-control" id="date_order" name="date_order"
                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

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

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/order" class="btn btn-secondary">Kembali</a>
          </form>

          @if ($errors->any())
          <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <table border="1" class="table table-bordered table-striped mt-5">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Order</th>
                  <th>Menu</th>
                  <th>Harga</th>
                  <th>Qty</th>
                  <th>Total Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($temp_order as $index => $order)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($order->date_order)->format('d-m-Y') }}
                    <input type="hidden" name="orders[{{ $index }}][date_order]"
                      value="{{ \Carbon\Carbon::parse($order->date_order)->format('Y-m-d') }}">
                  </td>
                  <td>
                    {{ $order->t_menu->name_menu ?? '-' }}
                    <input type="hidden" name="orders[{{ $index }}][menu_id]" value="{{ $order->menu_id }}">
                  </td>
                  <td>
                    Rp{{ number_format($order->price_menu, 0, ',', '.') }}
                    <input type="hidden" name="orders[{{ $index }}][price_menu]" value="{{ $order->price_menu }}">
                  </td>
                  <td>
                    {{ $order->qty_menu }}
                    <input type="hidden" name="orders[{{ $index }}][qty_order]" value="{{ $order->qty_menu }}">
                  </td>
                  <td>
                    Rp{{ number_format($order->subtotal_price, 0, ',', '.') }}
                    <input type="hidden" name="orders[{{ $index }}][subtotal_price]" value="{{ $order->subtotal_price }}">
                  </td>
                  <td>
                    {{-- Tombol hapus diarahkan ke form lain via "form" attribute --}}
                    <button type="submit" form="delete-form-{{ $order->id }}" 
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Hapus order ini?')">
                        Hapus
                    </button>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center">Belum ada data order</td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-success mt-3">Simpan Semua Order</button>
          </form>

          {{-- Form hapus dipisahkan dari form utama --}}
          @foreach($temp_order as $order)
          <form id="delete-form-{{ $order->id }}" 
                action="{{ route('temporder.destroy', $order->id) }}" 
                method="POST" style="display:none;">
              @csrf
              @method('DELETE')
          </form>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Simpan tanggal ke sessionStorage saat form disubmit
  document.getElementById('orderForm').addEventListener('submit', function (e) {
    let dateInput = document.getElementById('date_order').value;
    sessionStorage.setItem('date_order', dateInput);
  });

  // Saat halaman dimuat
  window.addEventListener('DOMContentLoaded', function () {
    let savedDate = sessionStorage.getItem('date_order');

    if (savedDate) {
      // kalau ada simpanan, pakai yang tersimpan
      document.getElementById('date_order').value = savedDate;
    } else {
      // kalau tidak ada simpanan, pakai tanggal hari ini
      let today = new Date().toISOString().split('T')[0];
      document.getElementById('date_order').value = today;
    }
  });
</script>
@endsection

@section('content-01')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">Create @yield('title')</h1>
  </div>
</div>

<div class="container mt-4">
  <!-- Formulir untuk membuat barang baru -->
  <form action="{{ route('temporder.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="date_order">Tanggal Order</label>
      <input type="date" class="form-control" id="date_order" name="date_order"
        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
    </div>

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

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/order" class="btn btn-secondary">Kembali</a>
  </form>

  <!-- <form action="{{ route('temporder.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="date_order">Tanggal Order</label>
      <input type="date" class="form-control" id="date_order" name="date_order" placeholder="Masukkan Tanggal Order"
        required>
    </div>

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
      <input type="text" class="form-control" id="qty_menu" name="qty_order" placeholder="Masukkan Jumlah Order"
        required>
    </div>

    <div class="form-group">
      <label for="note_order">Catatan</label>
      <input type="text" class="form-control" id="note_order" name="note_order" placeholder="Masukkan Catatan">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/order" class="btn btn-secondary">Kembali</a>
  </form> -->

  @if ($errors->any())
  <div class="alert alert-danger">
    <strong>Terjadi kesalahan!</strong>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="{{ route('order.store') }}" method="POST">
    @csrf
    <table border="1" class="table table-bordered table-striped mt-5">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Order</th>
          <th>Menu</th>
          <th>Harga</th>
          <th>Qty</th>
          <th>Total Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($temp_order as $index => $order)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>
            {{ \Carbon\Carbon::parse($order->date_order)->format('d-m-Y') }}
            <input type="hidden" name="orders[{{ $index }}][date_order]"
              value="{{ \Carbon\Carbon::parse($order->date_order)->format('Y-m-d') }}">
          </td>
          <td>
            {{ $order->t_menu->name_menu ?? '-' }}
            <input type="hidden" name="orders[{{ $index }}][menu_id]" value="{{ $order->menu_id }}">
          </td>
          <td>
            Rp{{ number_format($order->price_menu, 0, ',', '.') }}
            <input type="hidden" name="orders[{{ $index }}][price_menu]" value="{{ $order->price_menu }}">
          </td>
          <td>
            {{ $order->qty_menu }}
            <input type="hidden" name="orders[{{ $index }}][qty_order]" value="{{ $order->qty_menu }}">
          </td>
          <td>
            Rp{{ number_format($order->subtotal_price, 0, ',', '.') }}
            <input type="hidden" name="orders[{{ $index }}][subtotal_price]" value="{{ $order->subtotal_price }}">
          </td>
          <td>
            {{-- Tombol hapus diarahkan ke form lain via "form" attribute --}}
            <button type="submit" form="delete-form-{{ $order->id }}" 
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Hapus order ini?')">
                Hapus
            </button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center">Belum ada data order</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-success mt-3">Simpan Semua Order</button>
  </form>

  {{-- Form hapus dipisahkan dari form utama --}}
  @foreach($temp_order as $order)
  <form id="delete-form-{{ $order->id }}" 
        action="{{ route('temporder.destroy', $order->id) }}" 
        method="POST" style="display:none;">
      @csrf
      @method('DELETE')
  </form>
  @endforeach
</div>
@endsection