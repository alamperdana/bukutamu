<?php

namespace App\DataTables\Biaya;

use App\Models\Biaya\CostHarian;
use App\Traits\DatatableHelper;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CostHarianDataTable extends DataTable
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
            'walkot',
            'sekda',
            'eselon_2',
            'eselon_3',
            'eselon_4',
            'gol_4',
            'gol_3',
            'gol_2',
            'gol_1',
            'tkk'
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
    public function query(CostHarian $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('costharian-table')
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
            Column::make('walkot')->title('Walikota &<br>Ketua DPRD'),
            Column::make('sekda')->title('Sekda &<br>Anggota DPRD'),
            Column::make('eselon_2')->title('Eselon 2'),
            Column::make('eselon_3')->title('Eselon 3'),
            Column::make('eselon_4')->title('Eselon 4'),
            Column::make('gol_4')->title('Gol 4'),
            Column::make('gol_3')->title('Gol 3'),
            Column::make('gol_2')->title('Gol 2'),
            Column::make('gol_1')->title('Gol 1'),
            Column::make('tkk')->title('Honorer &<br>TKKP'),
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
        return 'CostHarian_' . date('YmdHis');
    }
}
