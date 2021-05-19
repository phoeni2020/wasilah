<?php if($customFields): ?>
<h5 class="col-12 pb-4"><?php echo trans('lang.main_fields'); ?></h5>
<?php endif; ?>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">
<!-- Name Field -->
<div class="form-group row ">
  <?php echo Form::label('name', trans("lang.category_name"), ['class' => 'col-3 control-label text-right']); ?>

  <div class="col-9">
    <?php echo Form::text('name', null,  ['class' => 'form-control','placeholder'=>  trans("lang.category_name_placeholder")]); ?>

    <div class="form-text text-muted">
      <?php echo e(trans("lang.category_name_help")); ?>

    </div>
  </div>
</div>

<!-- Description Field -->
<div class="form-group row ">
  <?php echo Form::label('description', trans("lang.category_description"), ['class' => 'col-3 control-label text-right']); ?>

  <div class="col-9">
    <?php echo Form::textarea('description', null, ['class' => 'form-control','placeholder'=>
     trans("lang.category_description_placeholder")  ]); ?>

    <div class="form-text text-muted"><?php echo e(trans("lang.category_description_help")); ?></div>
  </div>
</div>
</div>
<div style="flex: 50%;max-width: 50%;padding: 0 4px;" class="column">

<!-- Image Field -->
<div class="form-group row">
  <?php echo Form::label('image', trans("lang.category_image"), ['class' => 'col-3 control-label text-right']); ?>

  <div class="col-9">
    <div style="width: 100%" class="dropzone image" id="image" data-field="image">
      <input type="hidden" name="image">
    </div>
    <a href="#loadMediaModal" data-dropzone="image" data-toggle="modal" data-target="#mediaModal" class="btn btn-outline-<?php echo e(setting('theme_color','primary')); ?> btn-sm float-right mt-1"><?php echo e(trans('lang.media_select')); ?></a>
    <div class="form-text text-muted w-50">
      <?php echo e(trans("lang.category_image_help")); ?>

    </div>
  </div>
</div>
<?php $__env->startPrepend('scripts'); ?>
<script type="text/javascript">
    var var15866134771240834480ble = '';
    <?php if(isset($category) && $category->hasMedia('image')): ?>
    var15866134771240834480ble = {
        name: "<?php echo $category->getFirstMedia('image')->name; ?>",
        size: "<?php echo $category->getFirstMedia('image')->size; ?>",
        type: "<?php echo $category->getFirstMedia('image')->mime_type; ?>",
        collection_name: "<?php echo $category->getFirstMedia('image')->collection_name; ?>"};
    <?php endif; ?>
    var dz_var15866134771240834480ble = $(".dropzone.image").dropzone({
        url: "<?php echo url('uploads/store'); ?>",
        addRemoveLinks: true,
        maxFiles: 1,
        init: function () {
        <?php if(isset($category) && $category->hasMedia('image')): ?>
            dzInit(this,var15866134771240834480ble,'<?php echo url($category->getFirstMediaUrl('image','thumb')); ?>')
        <?php endif; ?>
        },
        accept: function(file, done) {
            dzAccept(file,done,this.element,"<?php echo config('medialibrary.icons_folder'); ?>");
        },
        sending: function (file, xhr, formData) {
            dzSending(this,file,formData,'<?php echo csrf_token(); ?>');
        },
        maxfilesexceeded: function (file) {
            dz_var15866134771240834480ble[0].mockFile = '';
            dzMaxfile(this,file);
        },
        complete: function (file) {
            dzComplete(this, file, var15866134771240834480ble, dz_var15866134771240834480ble[0].mockFile);
            dz_var15866134771240834480ble[0].mockFile = file;
        },
        removedfile: function (file) {
            dzRemoveFile(
                file, var15866134771240834480ble, '<?php echo url("categories/remove-media"); ?>',
                'image', '<?php echo isset($category) ? $category->id : 0; ?>', '<?php echo url("uplaods/clear"); ?>', '<?php echo csrf_token(); ?>'
            );
        }
    });
    dz_var15866134771240834480ble[0].mockFile = var15866134771240834480ble;
    dropzoneFields['image'] = dz_var15866134771240834480ble;
</script>
<?php $__env->stopPrepend(); ?>
</div>
<?php if($customFields): ?>
<div class="clearfix"></div>
<div class="col-12 custom-field-container">
  <h5 class="col-12 pb-4"><?php echo trans('lang.custom_field_plural'); ?></h5>
  <?php echo $customFields; ?>

</div>
<?php endif; ?>
<!-- Submit Field -->
<div class="form-group col-12 text-right">
  <button type="submit" class="btn btn-<?php echo e(setting('theme_color')); ?>" ><i class="fa fa-save"></i> <?php echo e(trans('lang.save')); ?> <?php echo e(trans('lang.category')); ?></button>
  <a href="<?php echo route('categories.index'); ?>" class="btn btn-default"><i class="fa fa-undo"></i> <?php echo e(trans('lang.cancel')); ?></a>
</div>
<?php /**PATH /opt/lampp/htdocs/Back_End/resources/views/categories/fields.blade.php ENDPATH**/ ?>