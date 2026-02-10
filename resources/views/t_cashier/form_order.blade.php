<form action="{{ route('temporder.store') }}" method="POST">
  @csrf
  <input type="hidden" name="type_form" value="kasir">
  <input type="hidden" name="date_order" value="{{ now()->format('Y-m-d') }}">
  <input type="hidden" name="menu_id" value="{{ $data->id }}">

  <div class="d-flex align-items-center justify-content-between mt-3">
    <div class="input-group input-group-sm" style="width: 100px;">
      <div class="input-group-prepend">
        <button class="btn btn-outline-secondary px-2" type="button" onclick="this.parentNode.nextElementSibling.stepDown()">-</button>
      </div>
      <input type="number" name="qty_menu" class="form-control text-center bg-white" value="1" min="1" readonly>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary px-2" type="button" onclick="this.parentNode.previousElementSibling.stepUp()">+</button>
      </div>
    </div>

    <button type="submit" class="btn btn-primary btn-sm px-3 shadow-sm">
      <i class="fa fa-plus mr-1"></i> {{ $btnText ?? 'Tambah' }}
    </button>
  </div>
</form>