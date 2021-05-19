

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?php echo e(trans('lang.Trips')); ?><small class="ml-3 mr-3">|</small><small><?php echo e(trans('lang.Inbound_trips')); ?></small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-dashboard"></i> <?php echo e(trans('lang.dashboard')); ?></a></li>
          <li class="breadcrumb-item"><a href="<?php echo route('orders.index'); ?>"><?php echo e(trans('lang.Trips')); ?></a>
          </li>
          <li class="breadcrumb-item active"><?php echo e(trans('lang.Inbound_trips')); ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
  <div class="clearfix"></div>
  <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo url()->current(); ?>"><i class="fa fa-list mr-2"></i><?php echo e(trans('lang.Inbound_trips')); ?></a>
        </li>
        <?php echo $__env->make('layouts.right_toolbar', compact('dataTable'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </ul>
    </div>
    <div class="card-body">
      <?php echo $__env->make('orders.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/orders/index.blade.php ENDPATH**/ ?>