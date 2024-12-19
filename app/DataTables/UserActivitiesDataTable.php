<?php

namespace App\DataTables;

use App\Models\UserActivities;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Carbon\Carbon;

class UserActivitiesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query){
                $action = "$query->action";
                return $action;
            })->addColumn('status', function ($query) {
                if ($query->action === 'login') {
                    return '<span class="badge badge-success">Login</span>';
                } elseif ($query->action === 'logout'){
                    return '<span class="badge badge-danger">Logout</span>';
                } else if ($query->action === 'copy') {
                    return '<span class="badge badge-primary">Copy</span>';
                } else if ($query->action === 'Open') {
                    return '<span class="badge badge-warning">Open</span>';
                }else {
                    return '<span class="badge badge-secondary">Empty</span>';
                }
            })
                ->editColumn('created_at', function ($query) {
                    return Carbon::parse($query->created_at)
                        ->setTimezone('Asia/Bangkok')
                        ->format('d/m/Y H:i:s');
                })
                ->editColumn('updated_at', function ($query) {
                    return Carbon::parse($query->updated_at)
                        ->setTimezone('Asia/Bangkok')
                        ->format('d/m/Y H:i:s');
                })
                ->addColumn('action', function ($query) {
                    if ($query->status === '1') {
                        return '<span class="badge badge-success">Active</span>';
                    } else {
                        return '<span class="badge badge-danger">InActive</span>';
                    }
                })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(UserActivities $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('UserActivities-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('user_name')->width(150),
            Column::make('url_name')->width(150),
            Column::make('ip_address')->width(150),
            Column::make('user_agent'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('status')
            ->exportable(false)
            ->printable(false)
            ->width(150)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserActivities_' . date('YmdHis');
    }
}
