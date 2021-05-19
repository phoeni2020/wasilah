
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Id Field -->
    <div class="form-group row ">
      {!! Form::label('user_id', trans("lang.cart_user_id"),['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
          {!! Form::textarea('freight_details',$data[0]['freight_details'],['name'=>'freight_details','readonly'=>true,'class' => 'form-control']) !!}
        <div class="form-text text-muted">{{ trans("lang.cart_user_id_help") }}</div>
        @error('freight_details')
          <div class="alert alert-danger">{{$message}}</div>
        @enderror
      </div>
    </div>
    <!-- Type Field -->
    <div class="form-group row ">
        {!! Form::label('phone', trans("lang.order_client_phone"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
          {!! Form::text('phone',$data[0]['phone'],['name'=>'phone','readonly'=>true,'class' => 'form-control']) !!}
          <div class="form-text text-muted">{{ trans("lang.order_client_phone") }}</div>
            @error('phone')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
      </div>
    <!-- Car Brand Field -->
    <div class="form-group row ">
        {!! Form::label('address', trans("lang.delivery_address"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
          {!! Form::text('address',$data[0]['address'],['name'=>'address','readonly'=>true,'class' => 'form-control']) !!}
          <div class="form-text text-muted">{{ trans("lang.delivery_address") }}</div>
            @error('address')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
      </div>
    <!-- Cancel Field -->
    <div class="form-group row ">
        {!! Form::label('status', trans("lang.freight_order_status"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            @php
                $key = $data[0]['is_cancelled'];
            @endphp
            <select class="select2 form-control" name="is_cancelled">
                <option @if($key == 0) selected @endif value="0">{{trans('lang.cancel')}}</option>
                <option @if($key == 1) selected @endif value="1">{{trans('lang.order_canceled')}}</option>
            </select>
            <div class="form-text text-muted">{{ trans("lang.freight_order_status") }}</div>
            @error('status')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
</div>

<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Username Field -->
    <div class="form-group row ">
        {!! Form::label('user_id', trans("lang.app_setting_mail_username"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <p class="form-control">{{$data[1][0]['name']}}</p>
            {!! Form::text('user_id',$data[1][0]['id'],['name'=>'user_id','hidden'=>true]) !!}
            <div class="form-text text-muted">{{ trans("lang.app_setting_mail_username") }}</div>
            @error('user_id')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <!-- Longitude Field -->
    <div class="form-group row ">
        {!! Form::label('freight_longitude', trans("lang.freight_longitude"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('longitude',$data[0]['longitude'],['name'=>'longitude','readonly'=>true,'class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.freight_longitude") }}</div>
            @error('longitude')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <!-- Latitude Field -->
    <div class="form-group row ">
        {!! Form::label('freight_latitude', trans("lang.freight_latitude"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('latitude',$data[0]['latitude'],['name'=>'latitude','readonly'=>true,'class' => 'form-control']) !!}
            <div class="form-text text-muted">{{ trans("lang.freight_latitude") }}</div>
            @error('latitude')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <!-- Status Field -->
    <div class="form-group row ">
        {!! Form::label('status', trans("lang.freight_order_status"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            @php
                $key = $data[0]['status'];
            @endphp
            <select class="select2 form-control" name="status">
                    <option @if($key == 0) selected @endif value="0">{{trans('lang.freight_order_0')}}</option>
                    <option @if($key == 1) selected @endif value="1">{{trans('lang.freight_order_1')}}</option>
                    <option @if($key == 2) selected @endif value="2">{{trans('lang.freight_order_2')}}</option>
                    <option @if($key == 3) selected @endif value="3">{{trans('lang.freight_order_3')}}</option>
                    <option @if($key == 4) selected @endif value="4">{{trans('lang.freight_order_4')}}</option>
            </select>
            <div class="form-text text-muted">{{ trans("lang.freight_order_status") }}</div>
            @error('status')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <!-- Driver_id Field -->
    <div class="form-group row ">
        {!! Form::label('driver_id', trans("lang.freight_order_driver"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <select class="select2 form-control select2-hidden-accessible"
                    tabindex="-1" aria-hidden="true" name="driver_id">

                @foreach($driver_arr as $driver)
                    <option @if($data[0]['driver_id'] == $driver->id) selected @endif value="{{$driver->id}}">{{$driver->name}}</option>
                @endforeach
            </select>
            <div class="form-text text-muted">{{ trans("lang.freight_order_driver") }}</div>
            @error('driver_id')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
</div>