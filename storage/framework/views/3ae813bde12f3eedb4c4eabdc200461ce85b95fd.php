
<?php $__env->startSection('content'); ?>
    <div class="card-body login-card-body">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?php echo e(__('auth.login_title')); ?></p>

            <form action="<?php echo e(url('/login')); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="input-group mb-3">
                    <input value="<?php echo e(old('email')); ?>" type="email" class="form-control <?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" placeholder="<?php echo e(__('auth.email')); ?>" aria-label="<?php echo e(__('auth.email')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    <?php if($errors->has('email')): ?>
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('email')); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div class="input-group mb-3">
                    <input value="<?php echo e(old('password')); ?>" type="password" class="form-control  <?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="<?php echo e(__('auth.password')); ?>" aria-label="<?php echo e(__('auth.password')); ?>">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <?php if($errors->has('password')): ?>
                        <div class="invalid-feedback">
                            <?php echo e($errors->first('password')); ?>

                        </div>
                    <?php endif; ?>
                </div>

                <div class="row mb-2">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label> <input type="checkbox" name="remember"> <?php echo e(__('auth.remember_me')); ?>

                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block"><?php echo e(__('auth.login')); ?></button>
                    </div>
                    <!-- /.col -->
                </div>
<?php if(env('APP_DEMO',false)): ?>
                <div class="row mb-2">
                    <div class="col-12 callout callout-success">
                        <h6 class="text-bold">Admin</h6>
                        <p><small>User: admin@demo.com | Password: 123456</small></p>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row mb-2">
                    <div class="col-12 callout callout-warning">
                        <h6 class="text-bold">Manager</h6>
                        <p><small>User: manager@demo.com | Password: 123456</small></p>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row mb-2">
                    <div class="col-12 callout callout-danger">
                        <h6 class="text-bold">Client</h6>
                        <p><small>User: client@demo.com | Password: 123456</small></p>
                    </div>
                    <!-- /.col -->
                </div>
<?php endif; ?>

            </form>

            <p class="mb-1 text-center">
                <a href="<?php echo e(url('/password/reset')); ?>"><?php echo e(__('auth.forgot_password')); ?></a>
            </p>
            <p class="mb-0 text-center">
                <a href="<?php echo e(url('/register')); ?>" class="text-center"><?php echo e(__('auth.register_new_member')); ?></a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.auth.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/auth/login.blade.php ENDPATH**/ ?>