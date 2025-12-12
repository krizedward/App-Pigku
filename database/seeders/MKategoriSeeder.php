<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MKategori;

class MKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        MKategori::create([
            'main_kategori' => 'Menu',
            'name_kategori' => 'Makanan',
            'note_kategori' => 'untuk semua menu makanan utama',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Menu',
            'name_kategori' => 'Minuman',
            'note_kategori' => 'untuk semua menu minuman',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Menu',
            'name_kategori' => 'Add On',
            'note_kategori' => 'untuk tambahan menu atau pelengkap',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pengeluaran',
            'name_kategori' => 'Bahan Baku / Stok',
            'note_kategori' => 'untuk pembelian bahan baku utama, stok barang dagangan, dan kebutuhan produksi',
            'is_active'     => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pengeluaran',
            'name_kategori' => 'Operasional',
            'note_kategori' => 'untuk rutin operasional usaha',
            'is_active'     => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pengeluaran',
            'name_kategori' => 'Gaji / Tenaga Kerja',
            'note_kategori' => 'untuk gaji karyawan, tenaga kerja harian, lembur, serta tunjangan',
            'is_active'     => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pengeluaran',
            'name_kategori' => 'Peralatan & Pemeliharaan',
            'note_kategori' => 'untuk pembelian peralatan baru, perbaikan, serta pemeliharaan inventaris usaha',
            'is_active'     => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pengeluaran',
            'name_kategori' => 'Sewa / Cicilan',
            'note_kategori' => 'untuk sewa tempat usaha, cicilan pinjaman, maupun pembayaran kontrak jangka panjang',
            'is_active'     => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pengeluaran',
            'name_kategori' => 'Lain-lain',
            'note_kategori' => '(pengeluaran tidak rutin)',
            'is_active' => true,
        ]);
        

        MKategori::create([
            'main_kategori' => 'Pemasukan',
            'name_kategori' => 'Investasi',
            'note_kategori' => 'dana dari investor',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pemasukan',
            'name_kategori' => 'Modal Owner',
            'note_kategori' => 'tambahan modal dari pemilik usaha',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pemasukan',
            'name_kategori' => 'Pinjaman',
            'note_kategori' => 'dana masuk dari pinjaman (bank/perorangan)',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pemasukan',
            'name_kategori' => 'Penjualan Aset',
            'note_kategori' => 'penjualan barang inventaris lama',
            'is_active' => true,
        ]);

        MKategori::create([
            'main_kategori' => 'Pemasukan',
            'name_kategori' => 'Lain-lain',
            'note_kategori' => '(pemasukan tidak rutin)',
            'is_active' => true,
        ]);
    }
}