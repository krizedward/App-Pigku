<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon">
      <i class="fas fa-piggy-bank"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Apps Pigku</div>
  </a>
  
  <hr class="sidebar-divider my-0">
    
  <li class="nav-item">
    <a class="nav-link" href="/">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  @php
      // Ambil semua menu lalu kelompokkan berdasarkan kategori
      $menus = \DB::table('b_menu')->where('is_active', 'Y')->orderBy('menu_order', 'asc')->get()->groupBy('menu_category_code');
  @endphp

  @foreach ($menus as $categoryCode => $menuGroup)
    @php
        // Buat ID unik untuk collapse berdasarkan kategori
        $collapseId = 'collapse_' . $categoryCode;
        // Judul kategori – bisa disesuaikan (default: capitalized)
        $categoryTitle = ucfirst($categoryCode);
    @endphp
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse"
          data-target="#{{ $collapseId }}" aria-expanded="false"
          aria-controls="{{ $collapseId }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>{{ $categoryTitle }}</span>
        </a>
        <div id="{{ $collapseId }}" class="collapse"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ $categoryTitle }}:</h6>
                @foreach ($menuGroup as $menu)
                    <a class="collapse-item" href="{{ $menu->menu_code }}">
                        {{ $menu->menu_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </li>
  @endforeach

  @if(Auth::user()->t_pengguna->t_role->m_role->id == 1)

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-table"></i>
        <span>Master Data</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Master:</h6>
          <a class="collapse-item" href="{{ route('master-kategori.index') }}">Kategori</a>
          <a class="collapse-item" href="{{ route('master-payment.index') }}">Pembayaran</a>
          <a class="collapse-item" href="#">Barang</a>
          <a class="collapse-item" href="{{ route('master-role.index') }}">Role</a>
          {{-- <a class="collapse-item" href="#">Pengurus/Pemilik</a> --}}
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
        aria-controls="collapseThree">
        <i class="fas fa-fw fa-landmark"></i>
        <span>Keungan</span>
      </a>
      <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Keuangan :</h6>
          <a class="collapse-item" href="{{ route('saldo.index') }}">Saldo</a>
          {{-- <a class="collapse-item" href="#">Buku Kas</a>
          <a class="collapse-item" href="#">Penerimaan</a>
          <a class="collapse-item" href="#">Pengeluaran</a>
          <a class="collapse-item" href="#">Laporan Keuangan</a>
          <a class="collapse-item" href="#">Daftar Akun</a> --}}
        </div>
      </div>
    </li>
    {{--
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-home"></i>
        <span>Villa</span></a>
    </li>
    --}}

    <li class="nav-item">
      <a class="nav-link" href="{{ route('menu.index') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>Menu</span></a>
    </li>
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('expense.index') }}">
        <i class="fas fa-fw fa-file-invoice"></i>
        <span>Pengeluaran</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('order.index') }}">
        <i class="fas fa-fw fa-cash-register"></i>
        <span>Order</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-warehouse"></i>
        <span>Stok</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('pengguna.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Pengguna</span></a>
    </li>

    {{--
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="fas fa-fw fa-comment-dollar"></i>
        <span>Payment</span></a>
    </li>
    --}}
  
  @elseif(Auth::user()->t_pengguna->t_role->m_role->id == 2)
    
    <li class="nav-item">
      <a class="nav-link" href="{{ route('expense.index') }}">
        <i class="fas fa-fw fa-file-invoice"></i>
        <span>Pengeluaran</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('order.index') }}">
        <i class="fas fa-fw fa-cash-register"></i>
        <span>Order</span></a>
    </li>
  @endif
  
  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->