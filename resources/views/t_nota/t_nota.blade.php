@extends('layouts.app')

@section('title', 'Nota')

@section('content')
<style>
  input[type="date"] {
    position: relative;
    cursor: pointer;
  }
</style>

<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-info btn-icon-split" href="{{ route('cashier.index') }}">
      <span class="icon text-white-100">
        <i class="fas fa-cash-register"></i>
      </span>
      <span class="text">Kasir</span>
    </a>
  </div>
</div>

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <form method="GET" action="{{ route('nota.filter') }}">
      <div class="row align-items-end mb-3">

        <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
          <label for="tanggal_awal">Tanggal Awal :</label>
          <input type="date"
                class="form-control"
                name="tanggal_awal"
                id="tanggal_awal"
                value="{{ request('tanggal_awal') }}">
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 mb-3">
          <label for="tanggal_akhir">Tanggal Akhir :</label>
          <input type="date"
                class="form-control"
                name="tanggal_akhir"
                id="tanggal_akhir"
                value="{{ request('tanggal_akhir') }}">
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 mb-3">
          <button type="submit" class="btn btn-primary btn-block">
            Filter
          </button>
        </div>

      </div>
    </form>

  </div>
</div>

<div class="row">

  @forelse($datas as $index => $data)
  <div class="col-xl-3 col-md-6 mb-4">
    <a href="{{ route('nota.detail', $data->code_order) }}" class="text-decoration-none">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row">
            
            <div class="col-12">
              <div class="font-weight-bold text-info mb-1">
                {{ $data->code_order ?? '-' }}
              </div>
            </div>

            <div class="col-7">
              <div class="mt-2 font-weight-bold">
                Total Rp {{ number_format($data->total_price,0,',','.') ?? '-' }}
              </div>
            </div>

            <div class="col-5 text-right">
              <div class="mt-2">
                {{ $data->total_item ?? '-' }} item
              </div>
            </div>

            {{-- STATUS PEMBAYARAN --}}
            <div class="col-12 mt-2">
              @if($data->t_sale?->status_sale == 'paid')
                  <span class="badge badge-success">Lunas</span>
              @else
                  <span class="badge badge-danger">Belum Bayar</span>
              @endif
            </div>

          </div>
        </div>
      </div>
    </a>
  </div>

  @empty
    <div class="col-12 text-center py-5">
        <h5 class="text-muted">Tidak ada data</h5>
    </div>
  @endforelse

</div>
@endsection