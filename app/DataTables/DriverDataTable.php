<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Driver;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class DriverDataTable extends DataTable
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
             ->editColumn('user.name', function ($driver) {
                return returnuserdata($driver, ['id','name'],'driver/data/'.$driver['id']);
            })
            ->editColumn('updated_at', function ($driver) {
                return getDateColumn($driver, 'updated_at');
            })
            ->editColumn('In_bound', function ($driver) {
                return getBooleanColumn($driver,'In_bound') ;
            })
            ->editColumn('available', function ($driver) {
                return getBooleanColumn($driver, 'available');
            })
            ->addColumn('action', 'drivers.datatables_actions')
            ->rawColumns(array_merge($columns, ['action']));

        return $dataTable;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            [
                'data' => 'user.name',
                'title' => trans('lang.driver_user_id'),

            ],
            [
                'data' => 'In_bound',
                'title' => trans('lang.bound'),

            ],
            [
                'data' => 'available',
                'title' => trans('lang.driver_available'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.driver_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Driver::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Driver::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.driver_' . $field->name),
                    'orderable' => false,
                    'searchable' => false,
                ]]);
            }
        }
        return $columns;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Driver $model)
    {
        return $model->newQuery()->with("user");
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
     * Export PDF using DOMPDF
     * @return mixed
     */
    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = PDF::loadView($this->printPreview, compact('data'));
        return $pdf->download($this->filename() . '.pdf');
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'driversdatatable_' . time();
    }
}