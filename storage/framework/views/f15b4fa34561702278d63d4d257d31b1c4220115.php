    <?php echo csrf_field(); ?>
    <!-- Car Id Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('', __('freight_order') , ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <?php echo Form::text('id', ['class' => 'col-3 control-label text-right','readonly'=>true]); ?>

      </div>
    </div>
    
    <!-- User Id Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('user_id', 'User Id:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
       <?php echo Form::text('owner_id',$car->owner_id, ['class' => 'col-3 control-label text-right','hidden'=>true]); ?>

      </div>
    </div>
    
       <!-- User Id Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('name', 'User name:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
          <p><?php echo $car->name; ?></p>
      </div>
    </div>
    
    <!-- Type Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('type', 'Type:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        
        
         <?php echo Form::text('type',$car->Type, ['class' => 'col-6 control-label text-right']); ?>

         
      </div>
    </div>
    
    <!-- Brand Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('brand', 'Brand:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
       
         <?php echo Form::text('brand',$car->brand, ['class' => 'col-6 control-label text-right']); ?>

      </div>
    </div>
        
    <!-- Color Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('color', 'Color:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        
         <?php echo Form::text('color',$car->color, ['class' => 'col-6 control-label text-right']); ?>

      </div>
    </div>
    
    <!-- Number Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('Number', 'Plate NO:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        
         <?php echo Form::text('number',$car->number, ['class' => 'col-6 control-label text-right']); ?>

      </div>
    </div>
    
    <!-- Capacity Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('quantity', 'Capacity:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        
           <?php echo Form::text('capacity',$car->capacity, ['class' => 'col-3 control-label text-right']); ?>

      </div>
    </div>
    
    <!-- Created At Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <p><?php echo $car->created_at; ?></p>
      </div>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <p><?php echo $car->updated_at; ?></p>
      </div>
    </div>
        
     <!-- Img id photo  Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('quantity', 'UserID Photo :', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <img class="form-group rounded" style="width:300px;max-height:150px;" src="<?php echo e($car->img_id); ?>">
      </div>
    </div>
       <!-- car img Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('quantity', 'Car Photo :', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <img class="form-group rounded" style="width:300px;max-height:150px;" src="<?php echo e($car->img_car_id); ?>">
      </div>
    </div><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/freight/show_fields.blade.php ENDPATH**/ ?>