    @csrf
    <!-- Car Id Field -->
    <div class="form-group row col-6">
      {!! Form::label('', __('freight_order') , ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        {!! Form::text('id', ['class' => 'col-3 control-label text-right','readonly'=>true,'class' => 'form-control']) !!}
      </div>
    </div>
    
    <!-- User Id Field -->
    <div class="form-group row col-6">
      {!! Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
       {!! Form::text('owner_id',$car->owner_id, ['class' => 'col-3 control-label text-right','hidden'=>true]) !!}
      </div>
    </div>
    
       <!-- User Id Field -->
    <div class="form-group row col-6">
      {!! Form::label('name', 'User name:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
          <p>{!! $car->name !!}</p>
      </div>
    </div>
    
    <!-- Type Field -->
    <div class="form-group row col-6">
      {!! Form::label('type', 'Type:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        {{--<p>{!! $car->Type !!}</p>--}}
        
         {!! Form::text('type',$car->Type, ['class' => 'col-6 control-label text-right']) !!}
         
      </div>
    </div>
    
    <!-- Brand Field -->
    <div class="form-group row col-6">
      {!! Form::label('brand', 'Brand:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
       {{-- <p>{!! $car->brand !!}</p>--}}
         {!! Form::text('brand',$car->brand, ['class' => 'col-6 control-label text-right']) !!}
      </div>
    </div>
        
    <!-- Color Field -->
    <div class="form-group row col-6">
      {!! Form::label('color', 'Color:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        {{--<p>{!! $car->color !!}</p>--}}
         {!! Form::text('color',$car->color, ['class' => 'col-6 control-label text-right']) !!}
      </div>
    </div>
    
    <!-- Number Field -->
    <div class="form-group row col-6">
      {!! Form::label('Number', 'Plate NO:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        {{--<p>{!! $car->number !!}</p>--}}
         {!! Form::text('number',$car->number, ['class' => 'col-6 control-label text-right']) !!}
      </div>
    </div>
    
    <!-- Capacity Field -->
    <div class="form-group row col-6">
      {!! Form::label('quantity', 'Capacity:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        {{--<p>{!! $car->capacity !!}</p>--}}
           {!! Form::text('capacity',$car->capacity, ['class' => 'col-3 control-label text-right']) !!}
      </div>
    </div>
    
    <!-- Created At Field -->
    <div class="form-group row col-6">
      {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <p>{!! $car->created_at !!}</p>
      </div>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group row col-6">
      {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <p>{!! $car->updated_at !!}</p>
      </div>
    </div>
        
     <!-- Img id photo  Field -->
    <div class="form-group row col-6">
      {!! Form::label('quantity', 'UserID Photo :', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <img class="form-group rounded" style="width:300px;max-height:150px;" src="{{$car->img_id}}">
      </div>
    </div>
       <!-- car img Field -->
    <div class="form-group row col-6">
      {!! Form::label('quantity', 'Car Photo :', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <img class="form-group rounded" style="width:300px;max-height:150px;" src="{{$car->img_car_id}}">
      </div>
    </div>