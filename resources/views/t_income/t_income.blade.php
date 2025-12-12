<h1>Pemasukan</h1>

<a href="/income/create">Tambah +</a>
|
<a href="/t_order/pilih-tanggal">Kembali</a>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tanggal</th>
      <th>Deskripsi</th>
      <th>Kategori</th>
      <th>Harga</th>
      <th>Catatan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datas as $data)
    <tr>
      <td>{{ $data->id }}</td>
      <td>{{ $data->date_expense }}</td>
      <td>{{ $data->description_expense }}</td>
      <td>{{ $data->m_kategori->name_kategori }}</td>
      <td>{{ $data->total_price }}</td>
      <td>{{ $data->note_expense ?? 'Tidak ada data' }}</td>
      <td colspan="2">
        <div class='d-flex'>
          <a class='btn btn-sm btn-warning mr-2' href="{{ route('menu.edit', $data->id) }}"><i class='fa fa-edit'>Edit</i></a>
          <form action="{{ route('menu.destroy', $data->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Yakin hapus?')" class='btn btn-sm btn-danger'><i
                class='fa fa-trash'>Hapus</i></button>
          </form>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>