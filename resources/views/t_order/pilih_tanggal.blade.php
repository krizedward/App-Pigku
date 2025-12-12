<div class="container">
  <h2>Pigku Pigku</h2>

  <hr>
  <a href="{{ route('menu.index') }}" class="btn btn-primary mb-3">Menu</a>
  |
  <a href="/order" class="btn btn-primary mb-3">Order</a>
  |
  <a href="/master-kategori" class="btn btn-primary mb-3">Kategori</a>
  |
  <a href="/expense" class="btn btn-primary mb-3">Pengeluaran</a>
  |
  <a href="/income" class="btn btn-primary mb-3">Pemasukan</a>
  <hr>
  <h4>Total Pendapatan: Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
  <hr>
  <h4>Total Pengeluaran: Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
  <hr>
  <h4>Total Balance: Rp{{ number_format($totalBalance, 0, ',', '.') }}</h4>
  <hr>
  <h4>Tanggal yang sudah ada</h4>
  <ul class="list-group">
    @forelse($dates as $d)
    <li class="list-group-item">
      <a href="{{ route('t_order.list', $d->date_order) }}">
        {{ \Carbon\Carbon::parse($d->date_order)->format('d-m-Y') }}
      </a>
    </li>
    @empty
    <li class="list-group-item text-muted">Belum ada tanggal order</li>
    @endforelse
  </ul>
</div>