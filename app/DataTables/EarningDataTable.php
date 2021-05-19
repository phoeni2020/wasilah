<?php

namespace App\DataTables;

use App\Models\CustomField;
use App\Models\Earning;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class EarningDataTable extends DataTable
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
        file_put_contents('test.txt',$dataTable);
        $columns = array_column($this->getColumns(), 'data');
        $dataTable = $dataTable
            ->editColumn('driver.name', function ($earning) {
                return getLinksColumnByRouteName([$earning->user], "users.edit",'id','name');
            })
            ->editColumn('updated_at', function ($earning) {
                return getDateColumn($earning, 'updated_at');
            })
            ->editColumn('total_earning', function ($earning) {
                return getPriceColumn($earning,'total_earning');
            })
            ->editColumn('admin_earning', function ($earning) {
                return getPriceColumn($earning,'admin_earning');
            })
            ->editColumn('driver_earning', function ($earning) {
                return getPriceColumn($earning,'driver_earning');
            })
            ->editColumn('total_credit_card', function ($earning) {
                return getPriceColumn($earning,'total_credit_card');
            })
            ->addColumn('action', 'earnings.datatables_actions')
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
                'title' => trans('lang.earning_market_id'),

            ],
            [
                'data' => 'total_trips',
                'title' => trans('lang.earning_total_orders'),

            ],
            [
                'data' => 'total_earning',
                'title' => trans('lang.earning_total_earning'),

            ],
            [
                'data' => 'admin_earning',
                'title' => trans('lang.earning_admin_earning'),

            ],
            [
                'data' => 'driver_earning',
                'title' => trans('lang.earning_market_earning'),

            ],
            [
                'data' => 'total_credit_card',
                'title' => trans('lang.earning_credit_card'),

            ],
            [
                'data' => 'updated_at',
                'title' => trans('lang.earning_updated_at'),
                'searchable' => false,
            ]
        ];

        $hasCustomField = in_array(Earning::class, setting('custom_field_models', []));
        if ($hasCustomField) {
            $customFieldsCollection = CustomField::where('custom_field_model', Earning::class)->where('in_table', '=', true)->get();
            foreach ($customFieldsCollection as $key => $field) {
                array_splice($columns, $field->order - 1, 0, [[
                    'data' => 'custom_fields.' . $field->name . '.view',
                    'title' => trans('lang.earning_' . $field->name),
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
    public function query(Earning $model)
    {
       return $model->newQuery()->where('is_debt','=','0')->with('driver')->with('user');
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
        return 'earningsdatatable_' . time();
    }
}