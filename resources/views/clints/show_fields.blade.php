    @csrf
    <!-- User Id Field -->
    <div class="form-group row col-6">
      {!! Form::label('userid', 'User Id:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <p>{!! $user->id !!}</p>
      </div>
    </div>

    <!-- User name Field -->
    <div class="form-group row col-6">
        {!! Form::label('name', 'User name:', ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <p>{!! $user->name !!}</p>
        </div>
    </div>

    <!-- phone Field -->
    <div class="form-group row col-6">
        {!! Form::label('phone', 'Phone:', ['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <p>{!! $user->phone !!}</p>
        </div>
    </div>

    <!-- User gender Field -->
    <div class="form-group row col-6">
        @if($user->gender == 'm')
          @php
            $label = 'clint_gender_m';
            $gender = 'male';
          @endphp
        @else
            @php
            $label = 'clint_gender_f';
            $gender = 'female';
            @endphp
        @endif
      {!! Form::label('user_id', __('lang.'.$label).': ', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <p>{!!$gender !!}</p>
        {!! Form::text('owner_id',$user->name, ['class' => 'col-3 control-label text-right','hidden'=>true]) !!}
      </div>
    </div>

    <!-- Created At Field -->
    <div class="form-group row col-6">
      {!! Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <p>{!! $user->created_at !!}</p>
      </div>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group row col-6">
      {!! Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <p>{!! $user->updated_at !!}</p>
      </div>
    </div>
        
     <!-- Img id photo  Field -->
    <div class="form-group row col-6">
      {!! Form::label('quantity', 'UserID Photo :', ['class' => 'col-3 control-label text-right']) !!}
      <div class="col-9">
        <img class="form-group rounded" style="width:300px;max-height:150px;" src="{{$user->img_url}}">
      </div>
    </div>
