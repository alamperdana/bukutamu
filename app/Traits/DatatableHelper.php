<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Route;

trait DatatableHelper
{
    public function basicActions($row): array
    {
        $actions = [];
        // if (Route::is('master-data.rekening.index') && user()->can('create '.request()->path())) {
        //     $actions['Tambah Pagu'] = route(str_replace('/','.', request()->path()).'.create');
        // }
        $actions['Detail'] = route(str_replace('/','.', request()->path()).'.show', $row->id);
        if (user()->can('update '.request()->path())) {
            $actions['Edit'] = route(str_replace('/','.', request()->path()).'.edit', $row->id);
        }
        if (user()->can('delete '.request()->path())) {
            $actions['Delete'] = route(str_replace('/','.', request()->path()).'.destroy', $row->id);
        }
        return $actions;
    }
}