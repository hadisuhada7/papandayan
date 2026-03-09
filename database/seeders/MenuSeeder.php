<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use App\Models\MenuNavigation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create menu groups with order
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

        // Menu navigations without group
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

        // Menu navigations for Tentang Kami group with order
        MenuNavigation::create([
            'name' => 'Profile Perusahaan',
            'url' => '/about#profiles',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 1
        ]);

        MenuNavigation::create([
            'name' => 'Visi & Misi',
            'url' => '/about#vision-mission',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 2
        ]);

        MenuNavigation::create([
            'name' => 'Jejak Langkah',
            'url' => '/about#histories',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 3
        ]);

        MenuNavigation::create([
            'name' => 'Struktur Organisasi',
            'url' => '/about#organizations',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 4
        ]);

        MenuNavigation::create([
            'name' => 'Manajemen Kami',
            'url' => '/about#managements',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 5
        ]);

        MenuNavigation::create([
            'name' => 'Area Jangkauan',
            'url' => '/about#areas',
            'is_active' => true,
            'menu_group_id' => $tentangKami->id,
            'order' => 6
        ]);

        // Menu navigations for Keberlanjutan group with order
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

        // Menu navigations for Hubungan Investor group with order
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
