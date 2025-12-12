@extends('layouts.app')

@section('title', 'Saldo')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-primary btn-icon-split" href="{{ route('saldo.create') }}">
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
        <h6 class="m-0 font-weight-bold text-primary">Tabel Data</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Showed:</div>
            <a class="dropdown-item" id="size-event-table" href="#">5</a>
            <a class="dropdown-item" id="size-event-table" href="#">10</a>
            <a class="dropdown-item" id="size-event-table" href="#">20</a>
            <a class="dropdown-item" id="size-event-table" href="#">100</a>
            <!-- <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Download</a> -->
          </div>
        </div>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="table-responsive my-2">
          <table class="table table-striped table-bordered mb-0" id="event-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th style="text-align: center;vertical-align: middle;">No</th>
                <th style="text-align: center;vertical-align: middle;">Tanggal Mulai</th>
                <th style="text-align: center;vertical-align: middle;">Tanggal Akhir</th>
                <th style="text-align: center;vertical-align: middle;">Saldo Awal</th>
                <th style="text-align: center;vertical-align: middle;">Saldo Akhir</th>
              </tr>
            </thead>

            <tbody id="event-table-body">
              @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ \Carbon\Carbon::parse($data->start_date)->format('d M Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($data->end_date)->format('d M Y') }}</td>
                  <td>Rp {{ number_format($data->starting_saldo, 0, ',', '.') }}</td>
                  <td>Rp {{ number_format($data->ending_saldo, 0, ',', '.') }}</td>
                </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection