@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')
<div class="row align-items-center mb-4">
  <div class="col">
    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
  </div>
  <div class="col-auto ms-auto">
    <a class="btn btn-primary btn-icon-split" href="{{ route('master-barang.create') }}">
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
                <th style="text-align: center;vertical-align: middle;">Nama</th>
                <th style="text-align: center;vertical-align: middle;">Brand</th>
                <th style="text-align: center;vertical-align: middle;">Volume</th>
                <th style="text-align: center;vertical-align: middle;">Satuan</th>
                <th style="text-align: center;vertical-align: middle;">Is Active</th>
                <th style="text-align: center;vertical-align: middle;">Catatan</th>
                <th style="width: 0;text-align: center;">Aksi</th>
              </tr>
            </thead>

            <tbody id="event-table-body">
              @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $data->name_barang }}</td>
                  <td>{{ $data->brand_barang }}</td>
                  <td>{{ $data->volume_barang }}</td>
                  <td>{{ $data->m_satuan->name_satuan }}</td>
                  <td>{{ $data->is_active }}</td>
                  <td>{{ $data->note_barang }}</td>
                  <td colspan="2">
                    <div class='d-flex'>
                        <a class='btn btn-sm btn-warning mr-2' href="{{ route('master-barang.edit', $data->id) }}"><i class='fa fa-edit'></i></a>
                        <form id="delete-form-{{ $data->id }}"
                            action="{{ route('master-barang.destroy', $data->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="button"
                                    onclick="confirmAlert({{ $data->id }})"
                                    class="btn btn-danger btn-sm">

                                <i class="fa fa-trash"></i>

                            </button>

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
    </div>
  </div>
</div>

<script>
    function confirmAlert(id) {

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
           }).then((result) => {
            if (result.value) {
                document.getElementById('delete-form-' + id).submit();
                // console.log(id)
            }
        })
    }
</script>
@endsection

@section('script')
    @if(session('success'))
        <script type="text/javascript">
            // function sweetAlert() 
            // {  
            // Swal.fire('Any fool can use a computer') 
            // }
            // function successAlert()
            // {
            //     Swal.fire(
            //         'Ini judul',
            //         'Ini text dibawah judul',
            //         'question'
            //     )
            // }
            // // sweetAlert();
            // successAlert();
            
            // success-alert
            Swal.fire({
                type: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            })
        </script>   
    @endif
@endsection