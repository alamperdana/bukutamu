<?php

namespace App\DataTables\Nodin;

use App\Models\Nodin\Nodin;
use App\Traits\DatatableHelper;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NodinDataTable extends DataTable
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
            ->editColumn('tgl_nodin', function ($row) {
                return \Carbon\Carbon::parse($row->tgl_nodin)
                    ->translatedFormat('j F Y');
            })
            ->editColumn('perihal', function ($row) {
                $text = e($row->perihal); // Ambil teks asli dari database
                $shortText = strlen($text) > 50 ? substr($text, 0, 50) . '...' : $text; // Potong teks jika lebih dari 50 karakter

                return '<span data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="tooltip-primary" title="' . $text . '">' . $shortText . '</span>';
            })
            ->setRowId(function ($row) {
                return 'row_' . $row->id;
            })
            ->addColumn('action', function ($row) {
                return view('actiontabler', compact('row'));
            })
            ->addIndexColumn()
            ->rawColumns(['perihal'])
            ->escapeColumns([]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Nodin $model): QueryBuilder
    {
        if (auth()->user()->hasRole('super admin')) {
            return $model->newQuery()->with('pejabat');
        }
        $tahun_session = session('tahun');
        $kode_session = session('kode_satker');

        return $model->newQuery()
            ->whereRaw("JSON_EXTRACT(session_input, '$.tahun') = ?", [$tahun_session])
            ->whereRaw("JSON_EXTRACT(session_input, '$.kode_satker') = ?", [$kode_session]);
        // return $model->newQuery()->select(['id', 'nomor', 'perihal', 'tgl_nodin', 'session_input']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('nodin-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'asc')
            ->parameters([
                'scrollY' => '300px',
                'scrollX' => true,
                'scrollCollapse' => false,
                'paging' => true,
                'processing' => true,
                'serverSide' => true,
                'responsive' => true,
                'autoWidth' => false,
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center')
                ->width(30),
                Column::make('tgl_nodin')
                ->title('Tanggal')
                ->visible(true),
                Column::make('nomor')
                    ->title('Nomor')
                    ->addClass('text-nowrap'),
            Column::make('perihal')
                ->title('Perihal')
                ->width(700)
                ->addClass('text-nowrap text-truncate'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
                ->title('Aksi'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Nodin_' . date('YmdHis');
    }
}
