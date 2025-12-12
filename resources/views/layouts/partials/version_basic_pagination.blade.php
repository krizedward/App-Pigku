@php
            $currentPage = $datas->currentPage();
            $lastPage = $datas->lastPage();
            $perPage = request('per_page');
            
            // Tentukan halaman yang akan ditampilkan
            $pagesToShow = [];

            if ($lastPage <= 5) {
                $pagesToShow = range(1, $lastPage);
            } else {
                $pagesToShow[] = 1;

                // Tentukan rentang halaman di sekitar halaman saat ini
                $start = max(2, $currentPage - 1);
                $end = min($lastPage - 1, $currentPage + 1);

                // Tambahkan halaman tengah jika tidak sama dengan 1 dan lastPage
                for ($i = $start; $i <= $end; $i++) {
                    $pagesToShow[] = $i;
                }

                if (!in_array($lastPage, $pagesToShow)) {
                    $pagesToShow[] = $lastPage;
                }

                // Hapus duplikat
                $pagesToShow = array_unique($pagesToShow);
                sort($pagesToShow);
            }
        @endphp

        <div class="d-flex flex-column flex-sm-row justify-content-end align-items-center mt-4">
            <div class="btn-group mb-2 mb-sm-0" role="group" aria-label="Pagination">
                {{-- Tombol Previous --}}
                @if ($currentPage > 1)
                    <a href="{{ $datas->url($currentPage - 1) }}{{ $perPage ? '&per_page=' . $perPage : '' }}" class="btn btn-primary"><<</a>
                @else
                    <a href="#" class="btn btn-primary disabled"><<</a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($pagesToShow as $i)
                    @if ($i == '...')
                        <span class="btn btn-outline-secondary disabled">...</span>
                    @else
                        <a href="{{ $datas->url($i) }}{{ $perPage ? '&per_page=' . $perPage : '' }}"
                        class="btn btn-outline-primary {{ $i == $currentPage ? 'active' : '' }}">
                            {{ $i }}
                        </a>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($currentPage < $lastPage)
                    <a href="{{ $datas->url($currentPage + 1) }}{{ $perPage ? '&per_page=' . $perPage : '' }}" class="btn btn-primary">>></a>
                @else
                    <a href="#" class="btn btn-primary disabled">>></a>
                @endif
            </div>
        </div>