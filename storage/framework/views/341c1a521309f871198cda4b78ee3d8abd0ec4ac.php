<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>_<?php echo e(strtoupper(app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    
    <meta content="<?php echo $__env->yieldContent('description', setting()->description[app()->getLocale() . '_description'] ?? null); ?>" name="description">
    <meta property="og:site_name" content="<?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>" />
    <meta property="og:title" content="<?php echo $__env->yieldContent('title', setting()->title[app()->getLocale() . '_title'] ?? null); ?>" />
    <meta property="og:description" content="<?php echo $__env->yieldContent('description', setting()->description[app()->getLocale() . '_description'] ?? null); ?>" />
    <meta property="og:type" content="products.buy" />
    <meta property="og:locale" content="<?php echo e(app()->getLocale()); ?>_<?php echo e(strtoupper(app()->getLocale())); ?>" />
    <meta property="og:url" content="<?php echo e(url()->current()); ?>" />
    <base href="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:image:url" content="<?php echo $__env->yieldContent('image', isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null); ?>" />
    <meta property="og:image:secure_url" content="<?php echo $__env->yieldContent('image', isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null); ?>" />
    <meta property="og:image:alt" content="<?php echo $__env->yieldContent('title', isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null); ?>" />
    <meta property="og:type" content="website" />
    <title><?php echo $__env->yieldContent('title', setting()->title[app()->getLocale() . '_title'] ?? null); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('assets/images/favicon/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/images/favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/images/favicon/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(asset('assets/images/favicon/site.webmanifest')); ?>">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo e(asset('assets/lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')); ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/eyvaz.css')); ?>">
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100  top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only"><?php echo app('translator')->get('additional.pages.welcome.loading'); ?></span>
            </div>
        </div>
        <!-- Spinner End -->

        <?php echo $__env->make('layouts.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('layouts.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Back to Top -->
        <a href="javascript:void(0)" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
                class="bi bi-arrow-up"></i></a>
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('assets/lib/chart/chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/easing/easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/waypoints/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/owlcarousel/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/tempusdominus/js/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/tempusdominus/js/moment-timezone.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>" type="text/javascript"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        <?php if(Session::has('message')): ?>
            toastr.success("<?php echo e(session('message')); ?>");
        <?php endif; ?>

        <?php if(Session::has('error')): ?>
            toastr.error("<?php echo e(session('error')); ?>");
        <?php endif; ?>

        <?php if(Session::has('info')): ?>
            toastr.info("<?php echo e(session('info')); ?>");
        <?php endif; ?>

        <?php if(Session::has('warning')): ?>
            toastr.warning("<?php echo e(session('warning')); ?>");
        <?php endif; ?>

        <?php if(Session::has('success')): ?>
            toastr.success("<?php echo e(session('success')); ?>");
        <?php endif; ?>
    </script>
    <script>
        function showalertmessage(message, type) {
            if (message != null && message.length > 0) {
                if (type == "success") {
                    toastr.success(message);
                } else if (type == "error") {
                    toastr.error(message);
                } else if (type == "info") {
                    toastr.info(message);
                } else if (type == "warning") {
                    toastr.warning(message);
                }
            }
        }
    </script>
    <script>
        function paymentmodal(type) {
            $("#paymentmodal").modal('show');
            $("#bank_type_selected").css('display', 'none');
            $("#share_type_selected").css('display', 'none');
            if (type != null && type == "bank") {
                $("#bank_type_selected").css('display', 'flex');
            } else if (type != null && type == "share") {
                $("#share_type_selected").css('display', 'flex');
            } else {
                $("#bank_type_selected").css('display', 'flex');
            }
        }

        function closepaymentmodal() {
            $("#paymentmodal").modal('hide');
            $("#bank_type_selected").css('display', 'none');
            $("#share_type_selected").css('display', 'none');
        }
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html>
<?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/layouts/app.blade.php ENDPATH**/ ?>