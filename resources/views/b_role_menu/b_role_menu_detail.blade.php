@extends('layouts.app')

@section('title', 'Akses Detail')

@section('content') 
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-success btn-icon-split" href="{{ route('akses.index') }}">
      <span class="icon text-white-100">
        <i class="fas fa-arrow-left"></i>
      </span>
      <span class="text">Back</span>
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
                <th style="text-align: center;vertical-align: middle;">Nama Menu</th>
                <th style="width: 0;text-align: center;">Aksi</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($menus as $index => $menu)
                  @php
                      // default OFF jika tidak ada di b_role_menu
                      $status = $roleMenus[$menu->id] ?? 'N';
                  @endphp

                  <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $menu->menu_name }}</td>
                      <td>
                          <form action="{{ route('akses.toggle', [$id, $menu->id]) }}" method="POST">
                              @csrf
                              @method('PATCH')

                              <button type="submit"
                                  class="btn btn-sm {{ $status === 'Y' ? 'btn-success' : 'btn-secondary' }}">
                                  {{ $status === 'Y' ? 'ON' : 'OFF' }}
                              </button>
                          </form>
                      </td>
                  </tr>
              @endforeach
            </tbody>

          </table>
        </div>
        <div class="row align-items-center">
          <div class="col">
            <div class="mt-2">Showing page <a class="badge badge-primary" id="current-paging"></a></div>
          </div>
          <div class="col-auto ms-auto">
            <div class="btn-group mt-2 mb-2 mb-sm-0" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-primary" id="previous-page-event-table">Previous</button>
              <button type="button" class="btn btn-primary" id="next-page-event-table">Next</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection