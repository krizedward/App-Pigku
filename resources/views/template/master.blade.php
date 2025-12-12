<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigku</title>
</head>
<body>
  <header>
    <h2>Pigku</h2>
    <nav>
      <a href="/barang">Barang</a>
        |
      <a href="/barang/create">Create</a>
      <!--  |
      <a href="/kontak">KONTAK</a> -->
    </nav>
  </header>
  <hr/>
  <br/>
  <br/>

  <!-- bagian ini menampung judul halaman blog -->
  <h3> @yield('judul') </h3>

  <!-- bagian ini menampung konten blog -->
  @yield('konten')

  <br/>
  <br/>
  <hr/>

  <footer>
    <p>Copyright &copy; 2025 </p>
  </footer>
</body>
</html>
