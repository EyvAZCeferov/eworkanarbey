<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('additional.pages.login.forgetpassword'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <a href="<?php echo e(route('welcome')); ?>" class="navbar-brand mx-4 mb-3">
                            <h3 class="text-primary">
                                <img class="img-responsive img-fluid"
                                    src="<?php echo e(isset(setting()->logo_dark_mode) && !empty(setting()->logo_dark_mode) ? App\Helpers\Helper::getImageUrl(setting()->logo_dark_mode, 'settings') : null); ?>"
                                    alt="<?php echo e(setting()->title[app()->getLocale() . '_title'] ?? null); ?>">
                            </h3>
                        </a>
                    </div>
                    <form method="post" action="<?php echo e(route('forgetpassword.form')); ?>" id="loginform">
                        <?php echo csrf_field(); ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="xxxxxxx"
                                name="fin_code">
                            <label for="floatingInput"><?php echo app('translator')->get('additional.forms.fincode'); ?></label>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4"><?php echo app('translator')->get('additional.pages.login.forgetpassword'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/auth/forgetpassword.blade.php ENDPATH**/ ?>