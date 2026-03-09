@extends('layouts.app')

@section('title', 'Sale Edit')

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
          <form action="{{ route('sale.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="order_id">Order Id</label>
              <input type="text" class="form-control" id="order_id" name="order_id"
                value="{{ $data->order_id }}" placeholder="Masukkan Order Id" required>
            </div>

            <div class="form-group">
              <label for="payment_id">Payment Id</label>
              <input type="text" class="form-control" id="payment_id" name="payment_id"
                value="{{ $data->payment_id }}" placeholder="Masukkan Payment Id" required>
            </div>

            <div class="form-group">
              <label for="subtotal_sale">Subtotal Sale</label>
              <input type="text" class="form-control" id="subtotal_sale" name="subtotal_sale"
                value="{{ $data->subtotal_sale }}" placeholder="Masukkan Subtotal Sale" required>
            </div>

            <div class="form-group">
              <label for="tax_sale">Tax Sale</label>
              <input type="text" class="form-control" id="tax_sale" name="tax_sale" 
                value="{{ $data->tax_sale }}" placeholder="Masukkan Tax Sale" required>
            </div>

            <div class="form-group">
              <label for="discount_sale">Discount Sale</label>
              <input type="text" class="form-control" id="discount_sale" name="discount_sale" 
                value="{{ $data->discount_sale }}" placeholder="Masukkan Discount Sale" required>
            </div>

            <div class="form-group">
              <label for="total_sale">Total Sale</label>
              <input type="text" class="form-control" id="total_sale" name="total_sale" 
                value="{{ $data->total_sale }}" placeholder="Masukkan Total Sale" required>
            </div>

            <div class="form-group">
              <label for="paid_sale">Paid Sale</label>
              <input type="text" class="form-control" id="paid_sale" name="paid_sale" 
                value="{{ $data->paid_sale }}" placeholder="Masukkan Paid Sale" required>
            </div>

            <div class="form-group">
              <label for="change_sale">Change Sale</label>
              <input type="text" class="form-control" id="change_sale" name="change_sale" 
                value="{{ $data->change_sale }}" placeholder="Masukkan Change Sale" required>
            </div>

            <div class="form-group">
              <label for="status_sale">Status Sale</label>
              <input type="text" class="form-control" id="status_sale" name="status_sale" 
                value="{{ $data->status_sale }}" placeholder="Masukkan Status Sale" required>
            </div>

            <div class="form-group">
              <label for="note_sale">Catatan Sale</label>
              <input type="text" class="form-control" id="note_sale" name="note_sale" 
                value="{{ $data->note_sale }}" placeholder="Masukkan Catatan">
            </div>

            <div class="mt-4 mb-4">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{ route('sale.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection