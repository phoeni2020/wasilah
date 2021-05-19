
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- User Id Field -->
    <div class="form-group row ">
      <?php echo Form::label('user_id', trans("lang.cart_user_id"),['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
          <?php echo Form::textarea('freight_details',$data[0]['freight_details'],['name'=>'freight_details','readonly'=>true,'class' => 'form-control']); ?>

        <div class="form-text text-muted"><?php echo e(trans("lang.cart_user_id_help")); ?></div>
        <?php if ($errors->has('freight_details')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('freight_details'); ?>
          <div class="alert alert-danger"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
      </div>
    </div>
    <!-- Type Field -->
    <div class="form-group row ">
        <?php echo Form::label('phone', trans("lang.order_client_phone"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
          <?php echo Form::text('phone',$data[0]['phone'],['name'=>'phone','readonly'=>true,'class' => 'form-control']); ?>

          <div class="form-text text-muted"><?php echo e(trans("lang.order_client_phone")); ?></div>
            <?php if ($errors->has('phone')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('phone'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
      </div>
    <!-- Car Brand Field -->
    <div class="form-group row ">
        <?php echo Form::label('address', trans("lang.delivery_address"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
          <?php echo Form::text('address',$data[0]['address'],['name'=>'address','readonly'=>true,'class' => 'form-control']); ?>

          <div class="form-text text-muted"><?php echo e(trans("lang.delivery_address")); ?></div>
            <?php if ($errors->has('address')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('address'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
      </div>
    <!-- Cancel Field -->
    <div class="form-group row ">
        <?php echo Form::label('status', trans("lang.freight_order_status"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php
                $key = $data[0]['is_cancelled'];
            ?>
            <select class="select2 form-control" name="is_cancelled">
                <option <?php if($key == 0): ?> selected <?php endif; ?> value="0"><?php echo e(trans('lang.cancel')); ?></option>
                <option <?php if($key == 1): ?> selected <?php endif; ?> value="1"><?php echo e(trans('lang.order_canceled')); ?></option>
            </select>
            <div class="form-text text-muted"><?php echo e(trans("lang.freight_order_status")); ?></div>
            <?php if ($errors->has('status')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('status'); ?>
            <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
</div>

<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
    <!-- Username Field -->
    <div class="form-group row ">
        <?php echo Form::label('user_id', trans("lang.app_setting_mail_username"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <p class="form-control"><?php echo e($data[1][0]['name']); ?></p>
            <?php echo Form::text('user_id',$data[1][0]['id'],['name'=>'user_id','hidden'=>true]); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.app_setting_mail_username")); ?></div>
            <?php if ($errors->has('user_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('user_id'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
    <!-- Longitude Field -->
    <div class="form-group row ">
        <?php echo Form::label('freight_longitude', trans("lang.freight_longitude"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('longitude',$data[0]['longitude'],['name'=>'longitude','readonly'=>true,'class' => 'form-control']); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.freight_longitude")); ?></div>
            <?php if ($errors->has('longitude')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('longitude'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
    <!-- Latitude Field -->
    <div class="form-group row ">
        <?php echo Form::label('freight_latitude', trans("lang.freight_latitude"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php echo Form::text('latitude',$data[0]['latitude'],['name'=>'latitude','readonly'=>true,'class' => 'form-control']); ?>

            <div class="form-text text-muted"><?php echo e(trans("lang.freight_latitude")); ?></div>
            <?php if ($errors->has('latitude')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('latitude'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
    <!-- Status Field -->
    <div class="form-group row ">
        <?php echo Form::label('status', trans("lang.freight_order_status"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <?php
                $key = $data[0]['status'];
            ?>
            <select class="select2 form-control" name="status">
                    <option <?php if($key == 0): ?> selected <?php endif; ?> value="0"><?php echo e(trans('lang.freight_order_0')); ?></option>
                    <option <?php if($key == 1): ?> selected <?php endif; ?> value="1"><?php echo e(trans('lang.freight_order_1')); ?></option>
                    <option <?php if($key == 2): ?> selected <?php endif; ?> value="2"><?php echo e(trans('lang.freight_order_2')); ?></option>
                    <option <?php if($key == 3): ?> selected <?php endif; ?> value="3"><?php echo e(trans('lang.freight_order_3')); ?></option>
                    <option <?php if($key == 4): ?> selected <?php endif; ?> value="4"><?php echo e(trans('lang.freight_order_4')); ?></option>
            </select>
            <div class="form-text text-muted"><?php echo e(trans("lang.freight_order_status")); ?></div>
            <?php if ($errors->has('status')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('status'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
    <!-- Driver_id Field -->
    <div class="form-group row ">
        <?php echo Form::label('driver_id', trans("lang.freight_order_driver"),['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <select class="select2 form-control select2-hidden-accessible"
                    tabindex="-1" aria-hidden="true" name="driver_id">

                <?php $__currentLoopData = $driver_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option <?php if($data[0]['driver_id'] == $driver->id): ?> selected <?php endif; ?> value="<?php echo e($driver->id); ?>"><?php echo e($driver->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div class="form-text text-muted"><?php echo e(trans("lang.freight_order_driver")); ?></div>
            <?php if ($errors->has('driver_id')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('driver_id'); ?>
                <div class="alert alert-danger"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
        </div>
    </div>
</div><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/freight/fields_create.blade.php ENDPATH**/ ?>