<?php

use App\Models\Konfigurasi\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

if (!function_exists('responseError')) {
    function responseError(\Exception | string $th) 
    {
        $message = 'Terjadi kesalahan, silahkan coba beberapa saat lagi';
        if ($th instanceof \Exception) {
            if (config('app.debug')) {
                $message = $th->getMessage();
                $message .= ' in line'. $th->getLine(). ' at'. $th->getFile();
                $data = $th->getTrace();
            }
        } else {
            $message = $th;
        }

        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $data ?? null
        ], 500);
    }
}

if (!function_exists('responseSuccess')) {
    function responseSuccess($isEdit = false) {
        $message = $isEdit ? 'Data berhasil diubah' : 'Data berhasil ditambah';
        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }
}

if (!function_exists('responseSuccessRestore')) {
    function responseSuccessRestore() {
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dikembalikan',
        ]);
    }
}

if (!function_exists('responseSuccessDelete')) {
    function responseSuccessDelete() {
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}

if (!function_exists('responseSuccessForceDelete')) {
    function responseSuccessForceDelete() {
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus permanen!',
        ]);
    }
}

if (!function_exists('menus')) {
    /**
     * @return Collection
     */

    function menus()
    {
        if (!Cache::has('menus')) {
            $menus = (new MenuRepository())->getMenus()->groupBy('category');
            
            Cache::forever('menus', $menus);
        } else {
            $menus = Cache::get('menus');
        }
        // dd($menus);
        return $menus;
    }
}

if (!function_exists('urlMenu')) {
    function urlMenu()
    {
        if (!Cache::has('urlMenu')) {
            
            $menus = menus()->flatMap(fn ($item) => $item );

            $url = [];
            foreach ($menus as $mm) {
                $url[] = $mm->url;
                foreach ($mm->subMenus as $sm) {
                    $url[] = $sm->url;
                }
            }
            Cache::forever('urlMenu', $url);
        } else {
            $url = Cache::get('urlMenu');
        }
        return $url;
    }
}

if (!function_exists('notifications')) {
    function notifications() {
        return user()->notifications;
    }
}

if (!function_exists('user')) {
    /**
     * @param string $id
     * @return \App\Models\User | string
     */
    function user($id = null) {
        if ($id) {
            return request()->user()->{$id};
        }
        return request()->user();
    }
}

if (!function_exists('convertToOrderedList')) {
    /**
     * Mengubah teks dengan tanda "-" menjadi daftar berurutan (<ol>)
     * 
     * @param string $text
     * @return string
     */
    function convertToOrderedList($text) {
        $lines = explode("\n", $text);
        $html = "<ol>";
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (strpos($trimmed, "- ") === 0) {
                $html .= "<li>" . substr($trimmed, 2) . "</li>";
            }
        }
        $html .= "</ol>";
        return $html;
    }
}