<?php

namespace App\DataTables\MasterData;

use App\Models\Pegawai;
use App\Traits\DatatableHelper;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PegawaiDataTable extends DataTable
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
                if ($row->pangkat && $row->pangkat->id == 34) {
                    return $row->pangkat->pangkat;
                }
                return $row->pangkat ? $row->pangkat->pangkat . ' (' . $row->pangkat->golongan . ')' : '-';
            })
            ->addColumn('eselon', function ($row) {
                return $row->eselon ? $row->eselon->nama_eselon : '-';
            })
            // ->addColumn('satker', function ($row) {
            //     return $row->satker ? $row->satker->name : '-';
            // })
            ->addColumn('action', function ($row) {
                $actions = $this->basicActions($row);
                return view('action', compact('actions'));
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pegawai $model): QueryBuilder
    {
        if (auth()->user()->hasRole('super admin')) {
            return $model->newQuery()->with('pangkat', 'satker');
        }
        $tahun_session = session('tahun');
        $kode_session = session('kode_satker');

        return $model->newQuery()
            ->whereRaw("JSON_EXTRACT(session_input, '$.tahun') = ?", [$tahun_session])
            ->whereRaw("JSON_EXTRACT(session_input, '$.kode_satker') = ?", [$kode_session])
            ->with('satker');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pegawai-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(2, 'asc')
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
            Column::make('nama_lengkap'),
            Column::make('eselon'),
            Column::make('nip'),
            Column::make('pangkat')->title('Pangkat'),
            Column::make('jabatan'),
            // Column::make('satker')->title('Instansi'),
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
        return 'Pegawai_' . date('YmdHis');
    }
}
