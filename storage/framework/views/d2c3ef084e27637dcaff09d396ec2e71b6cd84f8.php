    <?php echo csrf_field(); ?>
    <!-- User Id Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('userid', 'User Id:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <p><?php echo $user->id; ?></p>
      </div>
    </div>

    <!-- User name Field -->
    <div class="form-group row col-6">
        <?php echo Form::label('name', 'User name:', ['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <p><?php echo $user->name; ?></p>
        </div>
    </div>

    <!-- phone Field -->
    <div class="form-group row col-6">
        <?php echo Form::label('phone', 'Phone:', ['class' => 'col-3 control-label text-right']); ?>

        <div class="col-9">
            <p><?php echo $user->phone; ?></p>
        </div>
    </div>

    <!-- User gender Field -->
    <div class="form-group row col-6">
        <?php if($user->gender == 'm'): ?>
          <?php
            $label = 'clint_gender_m';
            $gender = 'male';
          ?>
        <?php else: ?>
            <?php
            $label = 'clint_gender_f';
            $gender = 'female';
            ?>
        <?php endif; ?>
      <?php echo Form::label('user_id', __('lang.'.$label).': ', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <p><?php echo $gender; ?></p>
        <?php echo Form::text('owner_id',$user->name, ['class' => 'col-3 control-label text-right','hidden'=>true]); ?>

      </div>
    </div>

    <!-- Created At Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('created_at', 'Created At:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <p><?php echo $user->created_at; ?></p>
      </div>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('updated_at', 'Updated At:', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <p><?php echo $user->updated_at; ?></p>
      </div>
    </div>
        
     <!-- Img id photo  Field -->
    <div class="form-group row col-6">
      <?php echo Form::label('quantity', 'UserID Photo :', ['class' => 'col-3 control-label text-right']); ?>

      <div class="col-9">
        <img class="form-group rounded" style="width:300px;max-height:150px;" src="<?php echo e($user->img_url); ?>">
      </div>
    </div>
<?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/clints/show_fields.blade.php ENDPATH**/ ?>