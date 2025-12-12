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
    <a class="nav-link" href="{{ route('dashboard.main') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  @php
    $roleId = Auth::user()->t_pengguna->t_role->id;
    // Ambil semua menu lalu kelompokkan berdasarkan kategori
    $menus = \DB::table('b_menu as m')
      ->join('b_role_menu as rm', 'm.id', '=', 'rm.bmenu_id')
      ->where('m.is_active', 'Y')
      ->where('rm.trole_id', $roleId)
      ->where('rm.is_active', 'Y')
      ->orderBy('m.menu_order', 'asc')
      ->get()->groupBy('menu_category_code');
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
                  <a class="collapse-item" href="{{ url($menu->menu_code) }}">
                    {{ $menu->menu_name }}
                  </a>
                @endforeach
            </div>
        </div>
    </li>
  @endforeach
  
  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->