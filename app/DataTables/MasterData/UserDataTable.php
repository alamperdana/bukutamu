<?php

namespace App\DataTables\MasterData;

use App\Models\User;
use App\Traits\DatatableHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    use DatatableHelper;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function($row) {
                // Menambahkan badge role di bawah nama
                $roles = $row->getRoleNames();
                return $row->name . $this->getRoleBadge($row->getRoleNames(), $row->isOnline());
            })
            ->addColumn('kode_satker', function($row) {
                return $row->satker ? $row->satker->name : '-';
            })
            ->addColumn('action', function ($row) {
                $actions = $this->basicActions($row);
                return view('action', compact('actions'));
            })
            ->addIndexColumn()
            ->rawColumns(['name', 'action']);
    }

    private function getRoleBadge($roles, $isOnline)
    {
        // Map role names into badge elements
        $roleBadges = $roles->map(function ($role) {
            return '<span class="badge-small rounded-pill bg-warning text-white me-1">Role : ' . ucfirst($role) . '</span>';
        });

        // Add online/offline status badge
        $statusBadge = $isOnline
            ? '<span class="badge-small bg-glow rounded-pill bg-success text-white me-1">Status : Online</span>'
            : '<span class="badge-small bg-glow rounded-pill bg-danger text-white me-1">Status : Offline</span>';

        return '<br> ' . $roleBadges->implode(' ') . '<br> ' . $statusBadge;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->with('roles');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'scrollY' => '300px',
                'scrollX' => true, // Scroll Y dengan ketinggian tertentu
                'scrollCollapse' => false, // Aktifkan collapsible scrolling
                'paging' => true,
                // 'initComplete' => "function() {
                //     $('thead th').addClass('text-center');
                // }"
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false)->addClass('text-center')->width(30),
            Column::make('name')->title('Name & Role')->orderable(false)->width(60),
            Column::make('username'),
            Column::make('email'),
            Column::make('kode_satker')->title('Satuan Kerja'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }
}
