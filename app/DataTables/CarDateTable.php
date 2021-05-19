<?php

namespace App\DataTables;

use App\Models\Car;
use App\Models\CustomField;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CarDateTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('id', function ($car) {
                return $car->id;
            })
            ->editColumn('Type', function ($car) {
                return $car->Type;
            })
            ->editColumn('brand', function ($car) {
                return $car->brand;
            })
            ->editColumn('color', function ($car) {
                return $car->color;
            })
            ->editColumn('number', function ($car) {
                return $car->number;
            })
            ->editColumn('capacity', function ($car) {
                return $car->capacity;
            })
            ->editColumn('updated_at', function ($car) {
                return $car->updated_at;
            })
            ->addColumn('action', 'car.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Car $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['title'=>trans('lang.actions'),'width' => '80px', 'printable' => false, 'responsivePriority' => '100'])
            ->parameters(array_merge(
                config('datatables-buttons.parameters'), [
                    'language' => json_decode(
                        file_get_contents(base_path('resources/lang/' . app()->getLocale() . '/datatable.json')
                        ), true)
                ]
            ));
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns =
            [
                [
                    'data' => 'id',
                    'title' => trans('lang.car.id'),
                ],
                [
                    'data' => 'Type',
                    'title' => trans('lang.car_type'),
                ],
                [
                    'data' => 'brand',
                    'title' => trans('lang.car_brand'),
                ],
                [
                    'data' => 'color',
                    'title' => trans('lang.car_color')
                ],
                [
                    'data' => 'number',
                    'title' => trans('lang.car_number'),

                ],
                [
                        'data' => 'owner_id',
                        'title' => trans('lang.owner_id'),
                ],
                [
                        'data' => 'capacity',
                        'title' => trans('lang.car_capacity'),

                ],
                [
                    'data' => 'updated_at',
                    'title' => trans('lang.car_updated_at'),

                ],
            ];
        $column = array_filter($columns);
        $hasCustomField = in_array(Car::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Car::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.car_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }

        return $column;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'cardatatable_' . time();
    }

    /**
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }
}