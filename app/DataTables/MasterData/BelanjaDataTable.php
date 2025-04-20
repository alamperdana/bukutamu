<?php

namespace App\DataTables\MasterData;

use App\Models\Belanja;
use App\Traits\DatatableHelper;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BelanjaDataTable extends DataTable
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
            ->addColumn('subkegiatan', function ($row) {
                return $row->subkegiatan ? $row->subkegiatan->subkegiatan : '-';
            })
            ->addColumn('kode_rekening', function ($row) {
                return $row->subkegiatan ? $row->subkegiatan->kode_subkegiatan . '.' . $row->kode_belanja : '-';
            })
            ->addColumn('total_pagu', function ($row) {
                return number_format($row->pagu->sum('pagu'), 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                return view('action', [
                    'actions' => $this->basicActions($row),
                    'row' => $row
                ]);
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Belanja $model): QueryBuilder
    {
        if (auth()->user()->hasRole('super admin')) {
            return $model->newQuery();
        }

        $tahun_session = session('tahun');
        $kode_session = session('kode_satker');

        return $model->newQuery()
            ->whereRaw("JSON_EXTRACT(session_input, '$.tahun') = ?", [$tahun_session])
            ->whereRaw("JSON_EXTRACT(session_input, '$.kode_satker') = ?", [$kode_session])
            ->with('subkegiatan', 'pagu');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('belanja-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'ASC')
            ->parameters([
                'dom' => 'frtip',
                'rowGroup' => [
                    'dataSrc' => 'subkegiatan', // Kolom yang digunakan untuk pengelompokan
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
            Column::make('kode_rekening')->title('Kode Rekening'),
            Column::make('rekening_belanja')->title('Rekening Belanja'),
            Column::make('total_pagu')->title('Total Pagu'),
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
        return 'Belanja_' . date('YmdHis');
    }
}
