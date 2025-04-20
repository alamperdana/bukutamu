<?php

namespace App\Http\Controllers\Konfigurasi;

use App\DataTables\Konfigurasi\MenuDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Konfigurasi\MenuRequest;
use App\Models\Konfigurasi\Menu;
use App\Models\Permission;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Mavinoo\Batch\BatchFacade;

class MenuController extends Controller
{
    public function __construct(private MenuRepository $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MenuDataTable $menuDataTable)
    {
        $this->authorize('read konfigurasi/menu');
        return $menuDataTable->render('pages.konfigurasi.menu');
    }

    public function sort()
    {
        $menus = $this->repository->getMenus();

        $data = [];
        $i = 0;
        foreach($menus as $mm) {
            $i ++;
            $data[] = ['id' => $mm->id, 'orders' => $i];
            foreach($mm->subMenus as $sm) {
                $i ++;
                $data[] = ['id' => $sm->id, 'orders' => $i];
            }
        }

        Cache::forget('menus');
        
        BatchFacade::update(new Menu(), $data, 'id');
        responseSuccess(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Menu $menu)
    {
        $this->authorize('create konfigurasi/menu');

        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.store'),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    private function fillData(MenuRequest $request, Menu $menu)
    {
        $menu->fill($request->validated());
        $menu->fill([
            'orders' => $request->orders,
            'icon' => $request->icon,
            'category' => $request->category,
            'main_menu_id' => $request->main_menu, 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request, Menu $menu)
    {
        DB::beginTransaction();
        try {
            $this->authorize('create konfigurasi/menu');
    
            $this->fillData($request, $menu);
            $menu->save();
    
            foreach ($request->permissions ?? [] as $permission) {
                Permission::create(['name' => $permission. " {$menu->url}"])->menus()->attach($menu);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return responseError($th);
        }

        return responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('pages.konfigurasi.menu-form', [
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $this->authorize('update konfigurasi/menu');

        return view('pages.konfigurasi.menu-form', [
            'action' => route('konfigurasi.menu.update', $menu->id),
            'data' => $menu,
            'mainMenus' => $this->repository->getMainMenus()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        // $this->authorize('update konfigurasi/menu');

        // $this->fillData($request, $menu);
        // if ($request->level_menu == 'main_menu') {
        //     $menu->main_menu_id = null;
        // }
        // $menu->save();

        // return responseSuccess(true);

        DB::beginTransaction();
        try {
            $this->authorize('update konfigurasi/menu');

            $oldUrl = $menu->getOriginal('url');
            $newUrl = $request->url;

            logger()->info("Old URL: {$oldUrl}, New URL: {$newUrl}");

            $this->fillData($request, $menu);
            $menu->save();
            logger()->info("Menu updated: ID {$menu->id}");

            if ($oldUrl !== $newUrl) {
                $permissions = Permission::where('name', 'like', "%{$oldUrl}%")->get();
                logger()->info("Permissions found: " . $permissions->count());

                foreach ($permissions as $permission) {
                    $permission->name = str_replace($oldUrl, $newUrl, $permission->name);
                    $permission->save();
                    logger()->info("Permission updated: {$permission->name}");
                }
            }

            DB::commit();
            return responseSuccess(true);
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error("Update failed: " . $th->getMessage());
            return responseError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        DB::beginTransaction();
        try {
            $this->authorize('delete konfigurasi/menu');

            // Ambil semua permission_id dari tabel permissions terkait menu yang akan dihapus
            $permissionIds = $menu->permissions()->pluck('permissions.id')->toArray();

            // Hapus relasi di tabel menu_permission
            $menu->permissions()->detach();

            // Hapus data di tabel permissions berdasarkan ID
            Permission::whereIn('id', $permissionIds)->delete();

            // Hapus data menu
            $menu->delete();

            DB::commit();

            return responseSuccessDelete();
        } catch (\Throwable $th) {
            DB::rollBack();
            logger()->error("Deletion failed: " . $th->getMessage());
            return responseError($th->getMessage());
        }
    }
}
