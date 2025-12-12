@extends('layouts.app')

@section('title', 'Saldo')

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
            <div class="form-group">
              <label for="start_date">Tanggal Mulai</label>
              <input type="date" class="form-control" id="start_date" name="start_date"
                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
              <label for="end_date">Tanggal Akhir</label>
              <input type="date" class="form-control" id="end_date" name="end_date"
                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
              <label for="starting_saldo">Saldo Awal</label>
              <input type="text" class="form-control" id="starting_saldo" name="starting_saldo" placeholder="Masukkan Saldo Awal"
                required>
            </div>

            <div class="form-group">
              <label for="income_saldo">Income Saldo</label>
              <input type="text" class="form-control" id="income_saldo" name="income_saldo" placeholder="Masukkan Income Saldo"
                required>
            </div>

            <div class="form-group">
              <label for="expense_saldo">Expense Saldo</label>
              <input type="text" class="form-control" id="expense_saldo" name="expense_saldo" placeholder="Masukkan Expense Saldo"
                required>
            </div>

            <div class="form-group">
              <label for="ending_saldo">Saldo Akhir</label>
              <input type="text" class="form-control" id="ending_saldo" name="ending_saldo" placeholder="Masukkan Saldo Akhir"
                required>
            </div>
            
            <div class="mt-4 mb-4">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('saldo.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection