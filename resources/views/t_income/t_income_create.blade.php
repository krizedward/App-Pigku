<h1>Pemasukan</h1>

<div class="container mt-4">
  <h2>Tambah Pengeluaran</h2>

  <!-- Formulir untuk membuat barang baru -->
  <form action="{{ route('tempexpense.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="date_expense">Tanggal Pengeluaran</label>
      <input type="date" class="form-control" id="date_expense" name="date_expense"
        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
    </div>

    <div class="form-group">
      <label for="kategori_id">Pilih Kategori</label>
      <select name="kategori_id" id="kategori_id" class="form-control">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $dt)
        <option value="{{ $dt->id }}">{{ $dt->name_kategori }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="description_expense">Deskripsi Pengeluaran</label>
      <input type="text" class="form-control" id="description_expense" name="description_expense" placeholder="Masukkan Deskripsi Pengeluaran"
        required>
    </div>

    <div class="form-group">
      <label for="total_price">Harga Pengeluaran</label>
      <input type="text" class="form-control" id="total_price" name="total_price" placeholder="Masukkan Harga Pengeluaran"
        required>
    </div>

    <div class="form-group">
      <label for="note_expense">Catatan Pengeluaran</label>
      <input type="text" class="form-control" id="note_expense" name="note_expense" placeholder="Masukkan Catatan">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/expense" class="btn btn-secondary">Kembali</a>
  </form>

  <!-- <form action="{{ route('temporder.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="date_order">Tanggal Order</label>
      <input type="date" class="form-control" id="date_order" name="date_order" placeholder="Masukkan Tanggal Order"
        required>
    </div>

    <div class="form-group">
      <label for="qty_menu">Jumlah Order</label>
      <input type="text" class="form-control" id="qty_menu" name="qty_order" placeholder="Masukkan Jumlah Order"
        required>
    </div>

    <div class="form-group">
      <label for="note_order">Catatan</label>
      <input type="text" class="form-control" id="note_order" name="note_order" placeholder="Masukkan Catatan">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/order" class="btn btn-secondary">Kembali</a>
  </form> -->
  
</div>