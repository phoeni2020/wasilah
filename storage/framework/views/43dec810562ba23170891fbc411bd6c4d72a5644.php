

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?php echo e(trans('lang.cart_plural')); ?><small class="ml-3 mr-3">|</small><small><?php echo e(trans('lang.cart_desc')); ?></small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('lang.dashboard')); ?></a></li>
          <li class="breadcrumb-itema ctive"><a href="<?php echo url('freight/'); ?>">Car</a>
          </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<div class="content">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo url('/car'); ?>"><i class="fa fa-list mr-2"></i><?php echo e(trans('lang.cart_table')); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo route('carts.create'); ?>"><i class="fa fa-plus mr-2"></i><?php echo e(trans('lang.cart_create')); ?></a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="row">

        <?php if(session()->has('done')): ?>
          <div class="alert alert-success"><?php echo e(session('done')); ?></div>
        <?php elseif(session()->has('error')): ?>
          <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
          <form method="post" class="row col-12" action="<?php echo e(url('/freight/order/update/'.$data[0]['id'])); ?>" >
            <?php echo method_field('PUT'); ?>
            <?php echo csrf_field(); ?>
              <?php echo $__env->make('freight.fields_create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="form-group col-12 text-right">
                <button type="submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i>Save</button> | 
                <a href="<?php echo url('/freight'); ?>" class="btn btn-default"><i class="fa fa-undo"></i> <?php echo e(trans('lang.back')); ?></a>
            </div>
          </form>
        <!-- Back Field -->
       
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/freight/show.blade.php ENDPATH**/ ?>