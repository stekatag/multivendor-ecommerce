<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable {
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.product.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('admin.product.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
                $settingsBtn = '                    
                    <div class="dropdown d-inline dropleft ml-2">
                      <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="' . route('admin.product-image-gallery.index', ['product' => $query->id]) . '"><i class="far fa-image"></i>Image Gallery</a>
                        <a class="dropdown-item has-icon" href="' . route('admin.product-variant.index', ['product' => $query->id]) . '"><i class="fas fa-layer-group"></i>Product Variant</a>
                        <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                      </div>
                    </div>';

                return $editBtn . ' ' . $deleteBtn . ' ' . $settingsBtn;
            })
            ->addColumn('thumb_image', function ($query) {
                return $img = "<img src='" . asset($query->thumb_image) . "' width='100' />";
            })
            ->addColumn('status', function ($query) {
                return generateSwitch('status', $query->status, $query->id, true);
            })
            ->addColumn('categories', function ($query) {
                $catName = '<div class="mb-1">' . ($query->category ? $query->category->name : '') . '</div>';
                if ($query->subcategory) {
                    $catName .= '<div class="mb-1">' . $query->subcategory->name . '</div>';
                }
                if ($query->childCategory) {
                    $catName .= '<div>' . $query->childCategory->name . '</div>';
                }
                return $catName;
            })
            ->addColumn('switches', function ($query) {
                return generateSwitch('is_new', $query->is_new, $query->id, true)
                    . generateSwitch('is_top', $query->is_top, $query->id)
                    . generateSwitch('is_best', $query->is_best, $query->id)
                    . generateSwitch('is_featured', $query->is_featured, $query->id);
            })

            ->rawColumns(['thumb_image', 'action', 'status', 'categories', 'switches'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder {
        return $this->builder()
            ->setTableId('product-table')
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
    public function getColumns(): array {
        return [
            Column::make('id'),
            Column::make('thumb_image'),
            Column::make('name'),
            Column::make('price'),
            Column::make('categories'),
            Column::make('switches')->width(150),
            Column::make('status')->width(150),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string {
        return 'Product_' . date('YmdHis');
    }
}
