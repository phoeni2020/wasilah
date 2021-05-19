
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Name Field -->
    <div class="form-group row ">
        <?php echo Form::label('name', trans("lang.user_name"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('name',$user->name); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.user_name")); ?></div>
        </div>
    </div>
    <!-- Password Field -->
    <div class="form-group row ">
        <?php echo Form::label('car_type', trans("lang.user_password"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('password'); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.user_password")); ?></div>
        </div>
    </div>

</div>


<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Gender Field -->
    <div class="form-group row ">
        <?php echo Form::label('gender', trans("lang.gender"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <select class="select2 form-control select2-hidden-accessible"
                    tabindex="-1" aria-hidden="true" name="gender">
                <option value="m" ><?php echo e(__('lang.clint_gender_m')); ?></option>
                <option value="f"><?php echo e(__('lang.clint_gender_f')); ?></option>
            </select>
            <div class="form-text text-muted"><?php echo e(trans("lang.gender")); ?></div>
        </div>
    </div>
    <!-- Phone Field -->
    <div class="form-group row ">
        <?php echo Form::label('phone', trans("lang.user_phone"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('phone',$user->phone); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.user_phone")); ?></div>
        </div>
    </div>

    <div class="form-group row ">
        <?php echo Form::label('roles[]', trans("lang.user_role_id"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::select('roles[]', $role, $rolesSelected, ['class' => 'select2 form-control' , 'multiple'=>'multiple']); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.user_role_id_help")); ?></div>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
    <button type="submit" class="btn btn-<?php echo e(setting('theme_color')); ?>" ><i class="fa fa-save"></i> <?php echo e(trans('lang.save')); ?> <?php echo e(trans('lang.cart')); ?></button>
    <a href="<?php echo route('carts.index'); ?>" class="btn btn-default"><i class="fa fa-undo"></i> <?php echo e(trans('lang.cancel')); ?></a>
</div>
<?php /**PATH /opt/lampp/htdocs/Back_End/resources/views/clints/fields_edite.blade.php ENDPATH**/ ?>