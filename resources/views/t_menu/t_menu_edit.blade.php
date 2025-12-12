<h1>Edit Menu</h1>

<div class="container mt-4">
  <h2>Edit Menu</h2>

  <!-- Form edit menu -->
  <form action="{{ route('menu.update', $menu->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="name_menu">Nama Menu</label>
      <input type="text" 
             class="form-control" 
             id="name_menu" 
             name="name_menu" 
             value="{{ old('name_menu', $menu->name_menu) }}" 
             placeholder="Masukkan Nama Menu" 
             required>
    </div>

    <div class="form-group">
      <label for="price_menu">Harga Menu</label>
      <input type="text" 
             class="form-control" 
             id="price_menu" 
             name="price_menu" 
             value="{{ old('price_menu', $menu->price_menu) }}" 
             placeholder="Masukkan Harga Menu" 
             required>
    </div>

    <div class="form-group">
      <label for="kategori_id">Pilih Kategori</label>
      <select name="kategori_id" id="kategori_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategori as $k)
          <option value="{{ $k->id }}" 
            {{ old('kategori_id', $menu->kategori_id) == $k->id ? 'selected' : '' }}>
            {{ $k->name_kategori }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="note_menu">Catatan Menu</label>
      <input type="text" 
             class="form-control" 
             id="note_menu" 
             name="note_menu" 
             value="{{ old('note_menu', $menu->note_menu) }}" 
             placeholder="Masukkan Catatan">
    </div>

    <div class="form-group">
      <label for="is_active">Active?</label>
      <select name="is_active" id="is_active" class="form-control" required>
        <option value="Y" {{ old('is_active', $menu->is_active) == 'Y' ? 'selected' : '' }}>Yes</option>
        <option value="N" {{ old('is_active', $menu->is_active) == 'N' ? 'selected' : '' }}>No</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('menu.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
