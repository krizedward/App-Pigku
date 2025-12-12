@extends('layouts.app')

@section('title', 'Pengeluaran')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">Create Edward @yield('title')</h1>
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
          <form action="{{ route('tempexpense.store') }}" method="POST" id="expenseForm">
            @csrf
            <input type="hidden" name="type_form" value="list_form">
            <div class="form-group">
              <label for="date_expense">Tanggal Pengeluaran</label>
              <input type="date" class="form-control" name="date_expense" value="{{ $tanggal }}" required>
            </div>

            <div class="form-group">
              <label for="kategori_id">Pilih Kategori</label>
              <select name="kategori_id" id="kategori_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $dt)
                <option value="{{ $dt->id }}">{{ $dt->name_kategori }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="description_expense">Deskripsi Pengeluaran</label>
              <input type="text" class="form-control" id="description_expense" name="description_expense"
                placeholder="Masukkan Deskripsi Pengeluaran" required>
            </div>

            <div class="form-group">
              <label for="total_price">Harga Pengeluaran</label>
              <input type="text" class="form-control" id="total_price" name="total_price"
                placeholder="Masukkan Harga Pengeluaran" required>
            </div>

            <div class="form-group">
              <label for="note_expense">Catatan Pengeluaran</label>
              <input type="text" class="form-control" id="note_expense" name="note_expense"
                placeholder="Masukkan Catatan">
            </div>

            <div class="form-group">
              <label for="payment_id">Pilih Pembayaran</label>
              <select name="payment_id" id="payment_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach($payment as $dt)
                <option value="{{ $dt->id }}">{{ $dt->description_payment }}</option>
                @endforeach
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('expense.list', $tanggal) }}" class="btn btn-secondary">Kembali</a>
          </form>

          <!-- <form action="{{ route('temporder.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="date_order">Tanggal Order</label>
              <input type="date" class="form-control" id="date_order" name="date_order" placeholder="Masukkan Tanggal Order"
                required>
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

          <form action="{{ route('expense.store') }}" method="POST">
            @csrf
            <input type="hidden" name="type_form" value="list_form">
            <input type="hidden" name="date_form" value="{{ $tanggal }}">
            <div class="table-responsive my-2">
              <table border="1" class="table table-bordered table-striped mt-5">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Payment</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($temp_expense as $index => $expense)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                      {{ \Carbon\Carbon::parse($expense->date_expense)->format('d-m-Y') }}
                      <input type="hidden" name="expenses[{{ $index }}][date_expense]"
                        value="{{ \Carbon\Carbon::parse($expense->date_expense)->format('Y-m-d') }}">
                    </td>
                    <td>
                      {{ $expense->description_expense ?? '-' }}
                      <input type="hidden" name="expenses[{{ $index }}][description_expense]"
                        value="{{ $expense->description_expense }}">
                    </td>
                    <td>
                      {{ $expense->m_kategori->name_kategori ?? '-' }}
                      <input type="hidden" name="expenses[{{ $index }}][kategori_id]"
                        value="{{ $expense->kategori_id }}">
                    </td>
                    <td>
                      Rp{{ number_format($expense->total_price, 0, ',', '.') }}
                      <input type="hidden" name="expenses[{{ $index }}][total_price]"
                        value="{{ $expense->total_price }}">
                    </td>
                    <td>
                      {{ $expense->m_payment->description_payment ?? '-' }}
                      <input type="hidden" name="expenses[{{ $index }}][payment_id]" value="{{ $expense->payment_id }}">
                    </td>
                    <td>
                      {{ $expense->note_expense ?? '-' }}
                      <input type="hidden" name="expenses[{{ $index }}][note_expense]"
                        value="{{ $expense->note_expense }}">
                    </td>
                    <td>
                      <button type="submit" form="delete-form-{{ $expense->id }}" class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus expense ini?')">
                        Hapus
                      </button>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" class="text-center">Belum ada data pengeluaran</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <br>
            <button type="submit" class="btn btn-success mt-2 mb-3">Simpan Semua Expense</button>
          </form>

          {{-- Form hapus dipisahkan dari form utama --}}
          @foreach($temp_expense as $expense)
          <form id="delete-form-{{ $expense->id }}" action="{{ route('tempexpense.destroy', $expense->id) }}"
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
@endsection