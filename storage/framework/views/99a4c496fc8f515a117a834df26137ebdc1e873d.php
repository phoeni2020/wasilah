<!DOCTYPE html>
<html lang="<?php echo e(setting('language','en')); ?>" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(setting('app_name')); ?> | <?php echo e(setting('app_short_description')); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="<?php echo e($app_logo); ?>"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="manifest" href="<?php echo e(request()->root()); ?>/public/manifest.json">

    <!-- Ionicons -->





<!-- Morris chart -->

<!-- jvectormap -->

<!-- Date Picker -->
<link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')); ?>">
<!-- Daterange picker -->




<?php echo $__env->yieldPushContent('css_lib'); ?>
<!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrap-sweetalert/sweetalert.css')); ?>">
    
    

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,600" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/'.setting("theme_color","primary").'.css')); ?>">
    <?php echo $__env->yieldContent('css_custom'); ?>
    <script>
                // Retrieve Firebase Messaging object.
        const messaging = firebase.messaging();messaging.requestPermission().then(function() {
          console.log('Notification permission granted.');
          // TODO(developer): Retrieve an Instance ID token for use with FCM.
          // ...
        }).catch(function(err) {
          console.log('Unable to get permission to notify.', err);
        });
    </script>
</head>

<body style="height: 100%; background-color: #f9f9f9;" class="hold-transition sidebar-mini <?php echo e(setting('theme_color')); ?>">
<?php if(auth()->check()): ?>
    <div class="wrapper">
        <!-- Main Header -->
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand <?php echo e(setting('fixed_header','')); ?> <?php echo e(setting('nav_color','navbar-light bg-white')); ?> border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo e(url('dashboard')); ?>" class="nav-link"><?php echo e(trans('lang.dashboard')); ?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <?php if(env('APP_CONSTRUCTION',false)): ?>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#"><i class="fa fa-info-circle"></i>
                            <?php echo e(env('APP_CONSTRUCTION','')); ?></a>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="<?php echo e(auth()->user()->getFirstMediaUrl('avatar','icon')); ?>" class="brand-image mx-2 img-circle elevation-2" alt="User Image">
                        <i class="fa fa fa-angle-down"></i> <?php echo auth()->user()->name; ?>


                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?php echo e(route('users.profile')); ?>" class="dropdown-item"> <i class="fa fa-user mr-2"></i> <?php echo e(trans('lang.user_profile')); ?> </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo url('/logout'); ?>" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-envelope mr-2"></i> <?php echo e(__('auth.logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Left side column. contains the logo and sidebar -->
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer <?php echo e(setting('fixed_footer','')); ?>">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> <?php echo e(implode('.',str_split(substr(config('installer.currentVersion','v100'),1,3)))); ?>

            </div>
            <strong>Copyright ?? <?php echo e(date('Y')); ?> <a href="<?php echo e(url('/')); ?>"><?php echo e(setting('app_name')); ?></a>.</strong> All rights reserved.
        </footer>

    </div>
<?php else: ?>
    <nav class="nmain-header navbar navbar-expand <?php echo e(setting('nav_color','navbar-light bg-white')); ?> border-bottom">
        <div class="container">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo url('/'); ?>"><?php echo e(setting('app_name')); ?></a>
                </li>
                <?php echo $__env->make('layouts.menu',['icons'=>false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <?php echo Auth::user()->name; ?>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?php echo e(route('users.profile')); ?>" class="dropdown-item"> <i class="fa fa-user mr-2"></i> Profile </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo url('/logout'); ?>" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-envelope mr-2"></i> <?php echo e(__('auth.logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
            <!-- Main Footer -->
            <footer class="<?php echo e(setting('fixed_footer','')); ?>">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> <?php echo e(implode('.',str_split(substr(config('installer.currentVersion','v100'),1,3)))); ?>

                </div>
                <strong>Copyright ?? <?php echo e(date('Y')); ?> <a href="<?php echo e(url('/')); ?>"><?php echo e(setting('app_name')); ?></a>.</strong> All rights reserved.
            </footer>
        </div>
    </div>

    <?php endif; ?>


    <!-- jQuery -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    
    
    
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="<?php echo e(asset('https://www.gstatic.com/firebasejs/7.2.0/firebase-app.js')); ?>"></script>

    <script src="<?php echo e(asset('https://www.gstatic.com/firebasejs/7.2.0/firebase-messaging.js')); ?>"></script>

    <script type="text/javascript"><?php echo $__env->make('vendor.notifications.init_firebase', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></script>

    <script type="text/javascript">
        const messaging = firebase.messaging();
        navigator.serviceWorker.register("<?php echo e(url('firebase/sw-js')); ?>")
            .then((registration) => {
                messaging.useServiceWorker(registration);
                messaging.requestPermission()
                    .then(function() {
                        console.log('Notification permission granted.');
                        getRegToken();

                    })
                    .catch(function(err) {
                        console.log('Unable to get permission to notify.', err);
                    });
                messaging.onMessage(function(payload) {
                    console.log("Message received. ", payload);
                    notificationTitle = payload.data.title;
                    notificationOptions = {
                        body: payload.data.body,
                        icon: payload.data.icon,
                        image:  payload.data.image
                    };
                    var notification = new Notification(notificationTitle,notificationOptions);
                });
            });

        function getRegToken(argument) {
            messaging.getToken().then(function(currentToken) {
                if (currentToken) {
                    saveToken(currentToken);
                    console.log(currentToken);
                } else {
                    console.log('No Instance ID token available. Request permission to generate one.');
                }
            })
                .catch(function(err) {
                    console.log('An error occurred while retrieving token. ', err);
                });
        }


        function saveToken(currentToken) {
            $.ajax({
                type: "POST",
                data: {'device_token': currentToken, 'api_token': '<?php echo auth()->user()->api_token; ?>'},
                url: '<?php echo url('api/users',['id'=>auth()->id()]); ?>',
                success: function (data) {

                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    </script>

    <!-- Sparkline -->
    
    
    
    
    
    <!-- jQuery Knob Chart -->
    
    <!-- daterangepicker -->
    
    
    <!-- datepicker -->
    <script src="<?php echo e(asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    
    <!-- Slimscroll -->
    <script src="<?php echo e(asset('plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/bootstrap-sweetalert/sweetalert.min.js')); ?>"></script>
    <!-- FastClick -->
    
    <?php echo $__env->yieldPushContent('scripts_lib'); ?>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('dist/js/adminlte.js')); ?>"></script>
    
    
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>

    <script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyD-i4GHACnCquTxVjWAZwxYz4UjQ5FEOnU",
    authDomain: "garden-taxi.firebaseapp.com",
    databaseURL: "https://garden-taxi.firebaseio.com",
    projectId: "garden-taxi",
    storageBucket: "garden-taxi.appspot.com",
    messagingSenderId: "598937693364",
    appId: "1:598937693364:web:9d483caf090398f962bbe1",
    measurementId: "G-FK4Z54YRLM"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
</body>
</html><?php /**PATH /opt/lampp/htdocs/wasilah/resources/views/layouts/app.blade.php ENDPATH**/ ?>