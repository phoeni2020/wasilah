<div class="card <?php echo e(Request::is('users*') || Request::is('settings/permissions*') || Request::is('settings/roles*') ? '' : 'collapsed-card'); ?>">
    <div class="card-header">
        <h3 class="card-title"><?php echo e(trans('lang.permission_menu')); ?></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa <?php echo e(Request::is('settings/users*') || Request::is('settings/permissions*') || Request::is('settings/roles*') ? 'fa-minus' : 'fa-plus'); ?>"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="<?php echo route('permissions.index'); ?>" class="nav-link <?php echo e(Request::is('settings/permissions*') ? 'selected' : ''); ?>">
                    <i class="fa fa-inbox"></i> <?php echo e(trans('lang.permission_plural')); ?>

                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo route('roles.index'); ?>" class="nav-link <?php echo e(Request::is('settings/roles*') ? 'selected' : ''); ?>">
                    <i class="fa fa-inbox"></i> <?php echo e(trans('lang.role_plural')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo route('users.create'); ?>" class="nav-link <?php echo e(Request::is('users*') ? 'selected' : ''); ?>">
                    <i class="fa fa-users"></i> <?php echo e(trans('lang.user_plural')); ?>

                </a>
            </li>

        </ul>
    </div>
</div>

<div class="card <?php echo e(Request::is('settings/app/*') ||
             Request::is('settings/mail*') ||
             Request::is('settings/translation*') ||
             Request::is('settings/payment*') ||
             Request::is('settings/currencies*') ||
             Request::is('settings/customFields*')
 ? '' : 'collapsed-card'); ?>">
    <div class="card-header">
        <h3 class="card-title"><?php echo e(trans('lang.app_setting_globals')); ?></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa <?php echo e(Request::is('settings/app/*') ||
             Request::is('settings/mail*') ||
             Request::is('settings/translation*') ||
             Request::is('settings/payment*') ||
             Request::is('settings/currencies*') ||
             Request::is('settings/customFields*')
             ? 'fa-minus' : 'fa-plus'); ?>"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="<?php echo url('settings/app/globals'); ?>" class="nav-link <?php echo e(Request::is('settings/app/globals*') ? 'selected' : ''); ?>">
                    <i class="fa fa-cog"></i> <?php echo e(trans('lang.app_setting_globals')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/localisation'); ?>" class="nav-link <?php echo e(Request::is('settings/app/localisation*') ? 'selected' : ''); ?>">
                    <i class="fa fa-language"></i> <?php echo e(trans('lang.app_setting_localisation')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/social'); ?>" class="nav-link <?php echo e(Request::is('settings/app/social*') ? 'selected' : ''); ?>">
                    <i class="fa fa-globe"></i> <?php echo e(trans('lang.app_setting_social')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/payment/payment'); ?>" class="nav-link <?php echo e(Request::is('settings/payment*') ? 'selected' : ''); ?>">
                    <i class="fa fa-credit-card"></i> <?php echo e(trans('lang.app_setting_payment')); ?>

                </a>
            </li>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('currencies.index')): ?>
                <li class="nav-item">
                    <a href="<?php echo route('currencies.index'); ?>" class="nav-link <?php echo e(Request::is('settings/currencies*') ? 'selected' : ''); ?>" ><i class="nav-icon fa fa-dollar ml-1"></i> <?php echo e(trans('lang.currency_plural')); ?></a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a href="<?php echo url('settings/app/notifications'); ?>" class="nav-link <?php echo e(Request::is('settings/app/notifications*') || Request::is('notificationTypes*') ? 'selected' : ''); ?>">
                    <i class="fa fa-bell"></i> <?php echo e(trans('lang.app_setting_notifications')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mail/smtp'); ?>" class="nav-link <?php echo e(Request::is('settings/mail*') ? 'selected' : ''); ?>">
                    <i class="fa fa-envelope"></i> <?php echo e(trans('lang.app_setting_mail')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/translation/en'); ?>" class="nav-link <?php echo e(Request::is('settings/translation*') ? 'selected' : ''); ?>">
                    <i class="fa fa-language"></i> <?php echo e(trans('lang.app_setting_translation')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo route('customFields.index'); ?>" class="nav-link <?php echo e(Request::is('settings/customFields*') ? 'selected' : ''); ?>">
                    <i class="fa fa-list"></i> <?php echo e(trans('lang.custom_field_plural')); ?>

                </a>
            </li>

        </ul>
    </div>
</div>


<div class="card <?php echo e(Request::is('settings/mobile*') ? '' : 'collapsed-card'); ?>">
    <div class="card-header">
        <h3 class="card-title"><?php echo e(trans('lang.mobile_menu')); ?></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa <?php echo e(Request::is('settings/mobile*') ? 'fa-minus' : 'fa-plus'); ?>"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/globals'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/globals*') ? 'selected' : ''); ?>">
                    <i class="fa fa-inbox"></i> <?php echo e(trans('lang.mobile_globals')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/colors'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/colors*') ? 'selected' : ''); ?>">
                    <i class="fa fa-inbox"></i> <?php echo e(trans('lang.mobile_colors')); ?>

                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo url('settings/mobile/home'); ?>" class="nav-link <?php echo e(Request::is('settings/mobile/home*') ? 'selected' : ''); ?>">
                    <i class="fa fa-home"></i> <?php echo e(trans('lang.mobile_home')); ?>

                </a>
            </li>

        </ul>
    </div>
</div>
<?php /**PATH /opt/lampp/htdocs/Back_End/resources/views/layouts/settings/menu.blade.php ENDPATH**/ ?>