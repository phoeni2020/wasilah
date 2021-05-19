
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Id Field -->
    <div class="form-group row ">
      <?php echo Form::label('user_id', trans("lang.cart_user_id"),['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <select class="select2 form-control" name="owner_id">
          <?php $__currentLoopData = $user_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->user['id']); ?>"><?php echo e($user->user['name']); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="form-text text-muted"><?php echo e(trans("lang.cart_user_id_help")); ?></div>
      </div>
    </div>
    <!-- Type Field -->
    <div class="form-group row ">
        <?php echo Form::label('car_type', trans("lang.car_type"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
          <?php echo Form::text('Type'); ?>

          <div class="form-text text-muted"><?php echo e(trans("lang.car_type")); ?></div>
        </div>
      </div>
    <!-- Car Brand Field -->
    <div class="form-group row ">
        <?php echo Form::label('brand', trans("lang.car_brand"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
          <?php echo Form::text('brand'); ?>

          <div class="form-text text-muted"><?php echo e(trans("lang.car_brand")); ?></div>
        </div>
      </div>
</div>

<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Color Field -->
    <div class="form-group row ">
        <?php echo Form::label('car_color', trans("lang.car_color"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('color'); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.car_color")); ?></div>
        </div>
    </div>
    <!-- Number Field -->
    <div class="form-group row ">
        <?php echo Form::label('car_number', trans("lang.car_number"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('number'); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.car_number")); ?></div>
        </div>
    </div>
    <!-- Capacity Field -->
    <div class="form-group row ">
        <?php echo Form::label('capacity', trans("lang.car_capacity"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('capacity'); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.car_capacity")); ?></div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-<?php echo e(setting('theme_color')); ?>" ><i class="fa fa-save"></i> <?php echo e(trans('lang.save')); ?> <?php echo e(trans('lang.cart')); ?></button>
  <a href="<?php echo route('carts.index'); ?>" class="btn btn-default"><i class="fa fa-undo"></i> <?php echo e(trans('lang.cancel')); ?></a>
</div>
<?php /**PATH /opt/lampp/htdocs/Back_End/resources/views/car/fields_create.blade.php ENDPATH**/ ?>