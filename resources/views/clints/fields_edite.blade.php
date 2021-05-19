
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Name Field -->
    <div class="form-group row ">
        {!! Form::label('name', trans("lang.user_name"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('name',$user->name) !!}
            <div class="form-text text-muted">{{ trans("lang.user_name") }}</div>
        </div>
    </div>
    <!-- Password Field -->
    <div class="form-group row ">
        {!! Form::label('car_type', trans("lang.user_password"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('password') !!}
            <div class="form-text text-muted">{{ trans("lang.user_password") }}</div>
        </div>
    </div>

</div>


<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Gender Field -->
    <div class="form-group row ">
        {!! Form::label('gender', trans("lang.gender"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            <select class="select2 form-control select2-hidden-accessible"
                    tabindex="-1" aria-hidden="true" name="gender">
                <option value="m" >{{__('lang.clint_gender_m')}}</option>
                <option value="f">{{__('lang.clint_gender_f')}}</option>
            </select>
            <div class="form-text text-muted">{{ trans("lang.gender") }}</div>
        </div>
    </div>
    <!-- Phone Field -->
    <div class="form-group row ">
        {!! Form::label('phone', trans("lang.user_phone"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::text('phone',$user->phone) !!}
            <div class="form-text text-muted">{{ trans("lang.user_phone") }}</div>
        </div>
    </div>

    <div class="form-group row ">
        {!! Form::label('roles[]', trans("lang.user_role_id"),['class' => 'col-3 control-label text-right']) !!}
        <div class="col-9">
            {!! Form::select('roles[]', $role, $rolesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']) !!}
            <div class="form-text text-muted">{{ trans("lang.user_role_id_help") }}</div>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-{{setting('theme_color')}}" ><i class="fa fa-save"></i> {{trans('lang.save')}} {{trans('lang.cart')}}</button>
    <a href="{!! route('carts.index') !!}" class="btn btn-default"><i class="fa fa-undo"></i> {{trans('lang.cancel')}}</a>
</div>
