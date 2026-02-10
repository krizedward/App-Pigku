@extends('layouts.app')

@section('title', 'List Order')

@section('content')
<div class="row align-items-center mb-4">
    <div class="col">
        <h1 class="h3 mb-0 text-gray-800">Order ( {{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('d F Y') }} )</h1>
    </div>
    <div class="col-auto ms-auto">
        <a class="btn btn-primary btn-icon-split" href="{{ route('t_order.create', $date) }}">
        <span class="icon text-white-100">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah</span>
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
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
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
                    <table class="table table-striped table-bordered mb-0" id="event-table" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>

                        <tbody id="event-table-body">
                            @forelse($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->t_menu->name_menu ?? '-' }}</td>
                                <td>{{ $order->qty_order }}</td>
                                <td>Rp{{ number_format($order->total_price,0,',','.') }}</td>
                                <td>{{ $order->note_order ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada order di tanggal ini</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($orders->count() > 0)
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total Semua</th>
                                <th colspan="2">Rp{{ number_format($totalSemua,0,',','.') }}</th>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
                <div class="row align-items-center">
                    <div class="col">
                    </div>
                    @php
                    $parsedDate = \Carbon\Carbon::parse($date);
                    @endphp
                    <div class="col-auto ms-auto">
                        <div class="btn-group mt-2 mb-2 mb-sm-0" role="group" aria-label="Basic example">
                            <a href="{{ route('dashboard.main', ['bulan' => $parsedDate->format('m'), 'tahun' => $parsedDate->format('Y')]) }}" class="btn btn-secondary">
                            <!-- <a href="{{ route('dashboard.main', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" class="btn btn-secondary"> -->
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection