@extends('layouts.app')

@section('title', 'Akses')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
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
                <th style="text-align: center;vertical-align: middle;">Nama Pengguna</th>
                <th style="text-align: center;vertical-align: middle;">Role</th>
                <th style="text-align: center;vertical-align: middle;">Is Active</th>
                <th style="text-align: center;vertical-align: middle;">Create By</th>
                <th style="text-align: center;vertical-align: middle;">Created At</th>
                <th style="text-align: center;vertical-align: middle;">Update By</th>
                <th style="text-align: center;vertical-align: middle;">Updated At</th>
                <th style="width: 0;text-align: center;">Aksi</th>
              </tr>
            </thead>

            <tbody id="event-table-body">
              @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $data->t_pengguna->fullname_pengguna }}</td>
                  <td>{{ $data->m_role->name_role }}</td>
                  <td>{{ $data->is_active }}</td>
                  <td>{{ $data->create_by }}</td>
                  <td>{{ $data->created_at }}</td>
                  <td>{{ $data->update_by }}</td>
                  <td>{{ $data->updated_at }}</td>
                  <td colspan="2">
                    <div class='d-flex'>
                      <a class="btn btn-sm btn-primary mr-2" href="{{ route('akses.detail', [$data->id]) }}"><i class="fa fa-eye"></i></a>
                    </div>
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