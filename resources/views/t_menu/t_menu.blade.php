@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-primary btn-icon-split" href="{{ route('menu.create') }}">
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
      <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <!-- start -->
          <li class="nav-item">
            <a class="nav-link active" id="pills-detail1-tab" data-toggle="pill" aria-selected="true"
              href="#pills-detail1" role="tab" aria-controls="pills-detail1">Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-detail2-tab" data-toggle="pill" aria-selected="false" href="#pills-detail2"
              role="tab" aria-controls="pills-detail2">Paket</a>
          </li>
          <!-- end -->
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-detail1" role="tabpanel" aria-labelledby="pills-detail1-tab">
            <div class="table-responsive my-2">
              <table class="table table-striped table-bordered mb-0" id="event-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="text-align: center;vertical-align: middle;">No</th>
                    <th style="text-align: center;vertical-align: middle;">Nama Menu</th>
                    <th style="text-align: center;vertical-align: middle;">Kategori</th>
                    <th style="text-align: center;vertical-align: middle;">Harga Menu</th>
                    <th style="text-align: center;vertical-align: middle;">Catatan Menu</th>
                    <th style="width: 0;text-align: center;">Aksi</th>
                  </tr>
                </thead>

                <tbody id="event-table-body">
                  @foreach ($datas as $index => $data)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->name_menu }}</td>
                    <td>{{ $data->m_kategori->name_kategori }}</td>
                    <td>Rp {{ number_format($data->price_menu, 0, ',', '.') }}</td>
                    <td>{{ $data->note_menu ?? 'Tidak ada data' }}</td>
                    <td colspan="2">
                      <div class='d-flex'>
                        <a class='btn btn-sm btn-warning mr-2' href="{{ route('menu.edit', $data->id) }}"><i
                            class='fa fa-edit'></i></a>
                        <form action="{{ route('menu.destroy', $data->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" onclick="return confirm('Yakin hapus?')"
                            class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></button>
                        </form>
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

          <div class="tab-pane fade" id="pills-detail2" role="tabpanel" aria-labelledby="pills-detail2-tab">
            <div class="table-responsive my-2">
              <table class="table table-striped table-bordered mb-0" id="event-table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="text-align: center;vertical-align: middle;">No</th>
                    <th style="text-align: center;vertical-align: middle;">Nama Menu Paket</th>
                    <th style="text-align: center;vertical-align: middle;">Harga Menu Paket</th>
                    <th style="text-align: center;vertical-align: middle;">Catatan Menu Paket</th>
                    <th style="width: 0;text-align: center;">Aksi</th>
                  </tr>
                </thead>

                <tbody id="event-table-body">
                  @foreach ($paket as $index => $data)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->t_menu->name_menu }}</td>
                    <td>Rp {{ number_format($data->t_menu->price_menu, 0, ',', '.') }}</td>
                    <td>{{ $data->note_menu ?? 'Tidak ada data' }}</td>
                    <td>
                      <div class='d-flex'>
                        <a class='btn btn-sm btn-primary mr-2' href="{{ route('paket.menu.show', $data->id) }}"><i
                            class='fa fa-eye'></i></a>
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

  </div>
</div>
@endsection