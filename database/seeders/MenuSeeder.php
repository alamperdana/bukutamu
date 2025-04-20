<?php

namespace Database\Seeders;

use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use App\Traits\HasMenuPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class MenuSeeder extends Seeder
{
    use HasMenuPermission;

    public function run(): void
    {
        Cache::forget('menus');
        /**
         * @var Menu $mm
         */
        $mm = Menu::firstOrCreate(['url' => 'rekap'], ['name' => 'Rekap', 'category' => 'DASHBOARD', 'icon' => 'clipboard-check']);
        $this->attachMenuPermission($mm, ['read'], null);

        $mm = Menu::firstOrCreate(['url' => 'konfigurasi'], ['name' => 'Konfigurasi', 'category' => 'MASTER DATA', 'icon' => 'settings']);
        $this->attachMenuPermission($mm, ['read'], null);

        $sm = $mm->subMenus()->create(['name' => 'Menu', 'url' => $mm->url . '/menu', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['create', 'read', 'update', 'delete', 'sort'], null);
        $sm = $mm->subMenus()->create(['name' => 'Role', 'url' => $mm->url . '/roles', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['create', 'read', 'update', 'delete'], null);
        $sm = $mm->subMenus()->create(['name' => 'Permission', 'url' => $mm->url . '/permissions', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['create', 'read', 'update', 'delete'], null);
        $sm = $mm->subMenus()->create(['name' => 'Akses By Role', 'url' => $mm->url . '/akses-role', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['read', 'update'], null);
        $sm = $mm->subMenus()->create(['name' => 'Akses By User', 'url' => $mm->url . '/akses-user', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, ['read', 'update'], null);

        $mm = Menu::firstOrCreate(['url' => 'master-data'], ['name' => 'Master Data', 'category' => 'MASTER DATA', 'icon' => 'books']);
        $this->attachMenuPermission($mm, ['read'], null);

        $sm = $mm->subMenus()->create(['name' => 'User', 'url' => $mm->url . '/users', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, null, null);
        $sm = $mm->subMenus()->create(['name' => 'Tahun Anggaran', 'url' => $mm->url . '/tahun', 'category' => $mm->category]);
        $this->attachMenuPermission($sm, null, null);
    }
}
