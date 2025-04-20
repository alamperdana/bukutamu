<?php

namespace App\DataTables\Biaya;

use App\Models\Biaya\CostHarianDD;
use App\Traits\DatatableHelper;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CostHarianDDDataTable extends DataTable
{
    use DatatableHelper;
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $dataTable = (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                $actions = $this->basicActions($row);
                return view('action', compact('actions'));
            })
            ->addIndexColumn();

        // Kolom yang perlu diformat
        $columnsToFormat = [
            'lev_1',
            'lev_2',
            'lev_3',
            'lev_4',
            'lev_5',
            'lev_6'
        ];

        // Loop melalui kolom dan tambahkan format
        foreach ($columnsToFormat as $column) {
            $dataTable->editColumn($column, function ($data) use ($column) {
                return number_format($data->$column, 2, ',', '.');
            });
        }

        return $dataTable;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(CostHarianDD $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('costhariandd-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
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
            Column::make('tujuan')->title('Daerah Tujuan'),
            Column::make('satuan')->title('Satuan'),
            Column::make('lev_1')->title('Walikota & <br>Ketua DPRD'),
            Column::make('lev_2')->title('Sekda &<br>Anggota DPRD'),
            Column::make('lev_3')->title('Eselon 2'),
            Column::make('lev_4')->title('Eselon 3 &<br>Gol 4'),
            Column::make('lev_5')->title('Eselon 4 &<br>Gol 3'),
            Column::make('lev_6')->title('Gol 2,<br> Honorer & TKK'),
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
        return 'CostHarianDD_' . date('YmdHis');
    }
}
