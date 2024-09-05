<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.brand.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.brand.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";

                return $editBtn . ' ' . $deleteBtn;
            })
            ->addColumn('logo', function ($query) {
                return '<img src="' . asset($query->logo) . '" alt="' . $query->name . '" class="img-thumbnail" width="100">';
            })
            ->addColumn('is_featured', function ($query) {
                $active = '<i class="badge badge-success">Yes</i>';
                $inactive = '<i class="badge badge-danger">No</i>';

                $query->is_featured == 1 ? $is_featured = $active : $is_featured = $inactive;
                return $is_featured;
            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) { // Active status
                    $button = '<label class="custom-switch mt-2">
                                <input type="checkbox" checked name="custom-switch-checkbox" class="custom-switch-input change-status" data-id="' . $query->id . '">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Active</span>
                                </label>';
                } else { // Inactive status
                    $button = '<label class="custom-switch mt-2">
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input change-status" data-id="' . $query->id . '">
                                <span class="custom-switch-indicator"></span>
                                <span class="custom-switch-description">Inactive</span>
                                </label>';
                }
                return $button;
            })
            ->rawColumns(['action', 'logo', 'status', 'is_featured'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
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
    public function getColumns(): array {
        return [

            Column::make('id'),
            Column::make('logo')->width(200),
            Column::make('name')->title('Brand Name'),
            Column::make('is_featured')->title('Featured')->width(150),
            Column::make('status')->width(200),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'Brand_' . date('YmdHis');
    }
}
