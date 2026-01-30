<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuGroup;
use App\Models\MenuNavigation;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat grup menu dengan order
        $tentangKami = MenuGroup::create([
            'name' => 'Tentang Kami',
            'order' => 2
        ]);

        $keberlanjutan = MenuGroup::create([
            'name' => 'Keberlanjutan',
            'order' => 4
        ]);

        $hubunganInvestor = MenuGroup::create([
            'name' => 'Hubungan Investor',
            'order' => 5
        ]);

        // Menu tanpa grup (uncategorized) dengan order
        MenuNavigation::create([
            'name' => 'Beranda',
            'url' => '/',
            'is_active' => true,
            'menu_group_id' => null,
            'order' => 1
        ]);

        MenuNavigation::create([
            'name' => 'Bisnis Kami',
            'url' => '/business',
            'is_active' => true,
            'menu_group_id' => null,
            'order' => 3
        ]);

        MenuNavigation::create([
            'name' => 'Karir',
            'url' => '/career',
            'is_active' => true,
            'menu_group_id' => null,
            'order' => 6
        ]);

        // Menu grup Tentang Kami dengan order
        MenuNavigation::create([
            'name' => 'Profile Perusahaan',
            'url' => '/about',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 1
        ]);

        MenuNavigation::create([
            'name' => 'Visi & Misi',
            'url' => '#',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 2
        ]);

        MenuNavigation::create([
            'name' => 'Jejak Langkah',
            'url' => '#',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 3
        ]);

        MenuNavigation::create([
            'name' => 'Struktur Organisasi',
            'url' => '#',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 4
        ]);

        MenuNavigation::create([
            'name' => 'Manajemen Kami',
            'url' => '#',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 5
        ]);

        MenuNavigation::create([
            'name' => 'Area Jangkauan',
            'url' => '#',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 6
        ]);

        // Menu grup Keberlanjutan dengan order
        MenuNavigation::create([
            'name' => 'K3',
            'url' => '/safety',
            'is_active' => true,
            'menu_group_id' => $keberlanjutan->id,
            'order' => 1
        ]);

        MenuNavigation::create([
            'name' => 'CSR',
            'url' => '/socials',
            'is_active' => true,
            'menu_group_id' => $keberlanjutan->id,
            'order' => 2
        ]);

        MenuNavigation::create([
            'name' => 'Inisiatif',
            'url' => '/initiatives',
            'is_active' => true,
            'menu_group_id' => $keberlanjutan->id,
            'order' => 3
        ]);

        MenuNavigation::create([
            'name' => 'Laporan Dokumen',
            'url' => '/documents',
            'is_active' => true,
            'menu_group_id' => $keberlanjutan->id,
            'order' => 4
        ]);

        // Menu grup Hubungan Investor dengan order
        MenuNavigation::create([
            'name' => 'Laporan Tahunan',
            'url' => '/report',
            'is_active' => true,
            'menu_group_id' => $hubunganInvestor->id,
            'order' => 1
        ]);

        MenuNavigation::create([
            'name' => 'Laporan Keuangan',
            'url' => '/financial',
            'is_active' => true,
            'menu_group_id' => $hubunganInvestor->id,
            'order' => 2
        ]);

        MenuNavigation::create([
            'name' => 'Presentasi Investor',
            'url' => '/investor',
            'is_active' => true,
            'menu_group_id' => $hubunganInvestor->id,
            'order' => 3
        ]);

        MenuNavigation::create([
            'name' => 'Informasi Saham & Obligasi',
            'url' => '/stock',
            'is_active' => true,
            'menu_group_id' => $hubunganInvestor->id,
            'order' => 4
        ]);

        MenuNavigation::create([
            'name' => 'Rapat Umum Pemegang Saham',
            'url' => '/shareholder',
            'is_active' => true,
            'menu_group_id' => $hubunganInvestor->id,
            'order' => 5
        ]);
    }
}
