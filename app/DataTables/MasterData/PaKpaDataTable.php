<?php

namespace App\DataTables\MasterData;

use App\Models\PaKpa;
use App\Traits\DatatableHelper;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PaKpaDataTable extends DataTable
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
            ->addColumn('pangkat', function ($row) {
                return $row->pangkat ? $row->pangkat->pangkat . ' (' . $row->pangkat->golongan . ')' : '-';
            })
            ->addColumn('status', function ($row) {
                return $row->payes == 1 ? 'Pengguna Anggaran' : 'Kuasa Pengguna Anggaran';
            })
            ->setRowId(function ($row) {
                return 'row_' . $row->id;
            })
            ->setRowAttr([
                'data-id' => function ($row) {
                    return $row->id;
                },
            ])
            ->addColumn('action', function ($row) {
                $actions = $this->basicActions($row);
                return view('action', compact('actions'));
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PaKpa $model): QueryBuilder
    {
        if (auth()->user()->hasRole('super admin')) {
            return $model->newQuery()->with('pangkat');
        }
        $tahun_session = session('tahun');
        $kode_session = session('kode_satker');

        return $model->newQuery()
            ->whereRaw("JSON_EXTRACT(session_input, '$.tahun') = ?", [$tahun_session])
            ->whereRaw("JSON_EXTRACT(session_input, '$.kode_satker') = ?", [$kode_session]);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pakpa-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(2,'asc')
            ->parameters([
                'rowGroup' => [
                    'dataSrc' => 'status'
                ],
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
            Column::make('nama_lengkap'),
            Column::make('nip'),
            Column::make('pangkat')->title('Pangkat'),
            Column::make('jabatan')->width(700)->addClass('text-truncate'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PaKpa_' . date('YmdHis');
    }
}
