<?php

namespace App\DataTables;

use App\Models\Freight;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class FreightDataTable extends DataTable
{
    /**
     * custom fields columns
     * @var array
     */
    public static $customFields = [];
    private $status;
    private $attr_name;
    function __construct($attr = null)
    {
        $this->status = $attr;
    }

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
            ->editColumn('users.name', function ($driver) {
                return returnuserdata($driver, ['id','name'],'driver/data/'.$driver['id']);
            })
            ->editColumn('freight_details', function ($driver) {
                return$driver->freight_details;
            })
            ->editColumn('status', function ($driver) {
               return $driver->status;
            })
            ->editColumn('phone', function ($driver) {
                return $driver->phone;
            })
            ->editColumn('address', function ($driver) {
                return $driver->address;
            })
            ->editColumn('longitude', function ($driver) {
                return $driver->longitude;
            })
            ->editColumn('latitude', function ($driver) {
                return $driver->latitude;
            })
            ->editColumn('driver_id', function ($driver) {
                return $driver->driver_id;
            })
            ->addColumn('action', 'freight.datatables_actions')
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
        return
            [
                [
                    'data' => 'users.name',
                    'title' => trans('lang.driver_user_id'),

                ],
                [
                    'data' => 'freight_details',
                    'title' => trans('lang.cart_user_id_help'),
                ],
                [
                    'data' => 'status',
                    'title' => trans('lang.freight_order_status'),
                ],
                [
                    'data' => 'phone',
                    'title' => trans('lang.order_client_phone'),
                ],
                [
                    'data' => 'address',
                    'title' => trans('lang.delivery_address'),
                ],
                [
                    'data' => 'longitude',
                    'title' => trans('lang.freight_longitude'),
                ],
                [
                    'data' => 'latitude',
                    'title' => trans('lang.freight_latitude'),
                ],
                [
                    'data' => 'driver_id',
                    'title' => trans('lang.freight_order_driver'),
                ],
            ];
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Freight $model)
    {
            return Freight::Where('status','=',$this->status)->join('users','freight.user_id','=','users.id');

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