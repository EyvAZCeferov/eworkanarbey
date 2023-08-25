<?php $__env->startSection('title'); ?>
    <?php echo e($data->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary rounded mx-0">
            <div class="col-sm-12 col-md-12 col-lg-12 pt-5 text-center">
                <h3><?php echo e($data->title); ?></h3>
                <p><?php echo $data->body; ?></p>
                <br />
                <a class="btn btn-info" href="<?php echo e(route('notifications.index')); ?>"><?php echo app('translator')->get('additional.pages.welcome.notifications'); ?></a>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/notifications/show.blade.php ENDPATH**/ ?>