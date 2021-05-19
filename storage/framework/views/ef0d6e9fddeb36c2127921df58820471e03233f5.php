<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?php echo e(trans('lang.clint_plural')); ?><small class="ml-3 mr-3">|</small><small><?php echo e(trans('lang.clint')); ?></small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('lang.dashboard')); ?></a></li> |
          <li class="breadcrumb-itema active"><a href="<?php echo url('clint/'); ?>"><?php echo e(__('lang.clint_plural')); ?></a>
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
          <a class="nav-link" href="<?php echo url('/clint'); ?>"><i class="fa fa-list mr-2"></i><?php echo e(trans('lang.clint_plural')); ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo route('carts.create'); ?>"><i class="fa fa-plus mr-2"></i><?php echo e(trans('lang.clint')); ?></a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="row">
              <?php echo $__env->make('clints.show_fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Back Field -->
       
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/clints/show.blade.php ENDPATH**/ ?>