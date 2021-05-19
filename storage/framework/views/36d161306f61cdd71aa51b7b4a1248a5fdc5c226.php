<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('dashboard*') ? 'active' : ''); ?>" href="<?php echo url('dashboard'); ?>"><?php if($icons): ?>
                <i class="nav-icon fa fa-dashboard"></i><?php endif; ?>
            <p><?php echo e(trans('lang.dashboard')); ?></p></a>
    </li>
<?php endif; ?>
<li class="nav-header"><?php echo e(trans('lang.app_management')); ?></li>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('drivers.index')): ?>

    <li class="nav-item has-treeview
    <?php echo e(Request::is('users*') ?
       'menu-open' : ''); ?>">

        <a href="#" class="nav-link
         <?php echo e(Request::is('orders*') ||
              Request::is('orderStatuses*') ||
              Request::is('deliveryAddresses*')?
              'active' : ''); ?>">
            <?php if($icons): ?>
                <i class="nav-icon fa fa-id-card"></i><?php endif; ?>
            <p><?php echo e(trans('lang.user_table')); ?> <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('clint*') ? 'active' : ''); ?>" href="<?php echo url('clint'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-id-card"></i><?php endif; ?><p><?php echo e(__('lang.users')); ?></p></a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('drivers*') ? 'active' : ''); ?>" href="<?php echo route('drivers.index'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-id-card"></i><?php endif; ?><p><?php echo e(trans('lang.driver_plural')); ?> </p></a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('allbaned*') ? 'active' : ''); ?>" href="<?php echo url('allbaned/users/'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-id-card"></i><?php endif; ?><p>AllBaned Users</p></a>
            </li>
        </ul>
    </li>
<?php endif; ?>
<li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('car*') ? 'active' : ''); ?>" href="<?php echo url('/car'); ?>"><?php if($icons): ?>
                <i class="nav-icon fa fa-car"></i><?php endif; ?><p><?php echo e(trans('lang.car')); ?></p></p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                
                <a class="nav-link <?php echo e(Request::is('car*') ? 'active' : ''); ?>" href="<?php echo url('/car'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fa fa-car"></i><?php endif; ?><p><?php echo e(trans('lang.car')); ?></p></a>
            </li>
            <li class="nav-item">
                    
                    <a class="nav-link <?php echo e(Request::is('car*') ? 'active' : ''); ?>" href="<?php echo url('/car/create'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-car"></i><?php endif; ?><p><?php echo e(trans('lang.car_create')); ?></p></a>
            </li>

        </ul>
    </li>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders.index')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('orders*') || Request::is('orderStatuses*') || Request::is('deliveryAddresses*')? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('orders*') || Request::is('orderStatuses*') || Request::is('deliveryAddresses*')? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fa fa-car"></i><?php endif; ?>
            <p><?php echo e(trans('lang.Trips')); ?> <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('orders.index')): ?>
                <li class="nav-item">
                    
                    <a class="nav-link <?php echo e(Request::is('orders*') ? 'active' : ''); ?>" href="<?php echo route('orders.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-car"></i><?php endif; ?><p><?php echo e(trans('lang.Inbound_trips')); ?></p></a>
                </li>
                <li class="nav-item">

                    <a class="nav-link <?php echo e(Request::is('outbound') ? 'active' : ''); ?>" href="<?php echo url('outbound'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-car"></i><?php endif; ?><p><?php echo e(trans('lang.Out_Bound')); ?></p></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.index')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('marketsPayouts*') || Request::is('payments*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('marketsPayouts*') || Request::is('payments*') ? 'active' : ''); ?>"> <?php if($icons): ?>
                <i class="nav-icon fa fa-credit-card"></i><?php endif; ?>
            <p><?php echo e(trans('lang.payment_plural')); ?><i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payments.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('payments*') ? 'active' : ''); ?>" href="<?php echo route('payments.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-money"></i><?php endif; ?><p><?php echo e(trans('lang.payment_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('earnings.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('earnings*') ? 'active' : ''); ?>" href="<?php echo route('earnings.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-money"></i>
                        <?php endif; ?>
                        <p><?php echo e(trans('lang.earning_plural')); ?></p></a>

                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('driversPayouts.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('driversPayouts*') ? 'active' : ''); ?>" href="<?php echo route('driversPayouts.index'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-dollar"></i><?php endif; ?><p><?php echo e(trans('lang.drivers_payout_plural')); ?></p></a>
                </li>
            <?php endif; ?>
        </ul>
    </li>
<?php endif; ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('coupons.index')): ?>
    <li class="nav-item">
        <a class="nav-link <?php echo e(Request::is('coupons*') ? 'active' : ''); ?>" href="<?php echo route('coupons.index'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-ticket"></i><?php endif; ?><p><?php echo e(trans('lang.coupon_plural')); ?> <span class="right badge badge-danger">New</span></p></a>
    </li>
<?php endif; ?>

<li class="nav-header"><?php echo e(trans('lang.app_setting')); ?></li>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('app-settings')): ?>
    <li class="nav-item has-treeview <?php echo e(Request::is('settings/mobile*') || Request::is('slides*') ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e(Request::is('settings/mobile*') || Request::is('slides*') ? 'active' : ''); ?>">
            <?php if($icons): ?><i class="nav-icon fa fa-mobile"></i><?php endif; ?>
            <p>
                <?php echo e(trans('lang.mobile_menu')); ?>

                <i class="right fa fa-angle-left"></i>
            </p></a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/globals'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/globals*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-cog"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_globals')); ?> <span class="right badge badge-danger">New</span> </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/colors'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/colors*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-pencil"></i> <?php endif; ?> <p><?php echo e(trans('lang.mobile_colors')); ?> <span class="right badge badge-danger">New</span> </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/home'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/home*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-home"></i> <?php endif; ?> <p><?php echo e(trans('lang.mobile_home')); ?>

                        <span class="right badge badge-danger">New</span></p>
                </a>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('slides.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('slides*') ? 'active' : ''); ?>" href="<?php echo route('slides.index'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-magic"></i><?php endif; ?><p><?php echo e(trans('lang.slide_plural')); ?> <span class="right badge badge-danger">New</span></p></a>
                </li>
            <?php endif; ?>
        </ul>

    </li>
    <li class="nav-item has-treeview <?php echo e((Request::is('settings*') ||
     Request::is('users*')) && !Request::is('settings/mobile*')
        ? 'menu-open' : ''); ?>">
        <a href="#" class="nav-link <?php echo e((Request::is('settings*') ||
         Request::is('users*')) && !Request::is('settings/mobile*')
          ? 'active' : ''); ?>"> <?php if($icons): ?><i class="nav-icon fa fa-cogs"></i><?php endif; ?>
            <p><?php echo e(trans('lang.app_setting')); ?> <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo url('settings/app/globals'); ?>" class="nav-link <?php echo e(Request::is('settings/app/globals*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-cog"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_globals')); ?></p>
                </a>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users.index')): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('users*') ? 'active' : ''); ?>" href="<?php echo route('users.index'); ?>"><?php if($icons): ?>
                            <i class="nav-icon fa fa-users"></i><?php endif; ?>
                        <p><?php echo e(trans('lang.user_plural')); ?></p></a>
                </li>
            <?php endif; ?>

            <li class="nav-item has-treeview <?php echo e(Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'menu-open' : ''); ?>">
                <a href="#" class="nav-link <?php echo e(Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-user-secret"></i><?php endif; ?>
                    <p>
                        <?php echo e(trans('lang.permission_menu')); ?>

                        <i class="right fa fa-angle-left"></i>
                    </p></a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/permissions') ? 'active' : ''); ?>" href="<?php echo route('permissions.index'); ?>">
                            <?php if($icons): ?><i class="nav-icon fa fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.permission_table')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/permissions/create') ? 'active' : ''); ?>" href="<?php echo route('permissions.create'); ?>">
                            <?php if($icons): ?><i class="nav-icon fa fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.permission_create')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/roles') ? 'active' : ''); ?>" href="<?php echo route('roles.index'); ?>">
                            <?php if($icons): ?><i class="nav-icon fa fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.role_table')); ?></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(Request::is('settings/roles/create') ? 'active' : ''); ?>" href="<?php echo route('roles.create'); ?>">
                            <?php if($icons): ?><i class="nav-icon fa fa-circle-o"></i><?php endif; ?>
                            <p><?php echo e(trans('lang.role_create')); ?></p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('settings/customFields*') ? 'active' : ''); ?>" href="<?php echo route('customFields.index'); ?>"><?php if($icons): ?>
                        <i class="nav-icon fa fa-list"></i><?php endif; ?><p><?php echo e(trans('lang.custom_field_plural')); ?></p></a>
            </li>


            <li class="nav-item">
                <a href="<?php echo url('settings/app/localisation'); ?>" class="nav-link <?php echo e(Request::is('settings/app/localisation*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-language"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_localisation')); ?></p></a>
            </li>
            <li class="nav-item">
                <a href="<?php echo url('settings/translation/en'); ?>" class="nav-link <?php echo e(Request::is('settings/translation*') ? 'active' : ''); ?>">
                    <?php if($icons): ?> <i class="nav-icon fa fa-language"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_translation')); ?></p></a>
            </li>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currencies.index')): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo e(Request::is('settings/currencies*') ? 'active' : ''); ?>" href="<?php echo route('currencies.index'); ?>"><?php if($icons): ?><i class="nav-icon fa fa-dollar"></i><?php endif; ?><p><?php echo e(trans('lang.currency_plural')); ?></p></a>
            </li>
            <?php endif; ?>

            <li class="nav-item">
                <a href="<?php echo url('settings/payment/payment'); ?>" class="nav-link <?php echo e(Request::is('settings/payment*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-credit-card"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_payment')); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/social'); ?>" class="nav-link <?php echo e(Request::is('settings/app/social*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-globe"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_social')); ?></p>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?php echo url('settings/app/notifications'); ?>" class="nav-link <?php echo e(Request::is('settings/app/notifications*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-bell"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_notifications')); ?></p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mail/smtp'); ?>" class="nav-link <?php echo e(Request::is('settings/mail*') ? 'active' : ''); ?>">
                    <?php if($icons): ?><i class="nav-icon fa fa-envelope"></i> <?php endif; ?> <p><?php echo e(trans('lang.app_setting_mail')); ?></p>
                </a>
            </li>

        </ul>
    </li>
<?php endif; ?><?php /**PATH /opt/lampp/htdocs/Back_End/resources/views/layouts/menu.blade.php ENDPATH**/ ?>