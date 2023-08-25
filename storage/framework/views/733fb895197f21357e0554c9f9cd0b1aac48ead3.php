<?php $__env->startSection('title'); ?>
    <?php echo e($data->name[app()->getLocale() . '_name']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?>
    <?php echo e($data->description[app()->getLocale() . '_description']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row bg-secondary rounded mx-0">
            <div class="col-sm-12 col-md-12 col-lg-12 pt-5 text-center">
                <h3><?php echo e($data->name[app()->getLocale() . '_name']); ?></h3>
                <p><?php echo $data->description[app()->getLocale() . '_description']; ?></p>
                <?php if(isset($data->pdf) && !empty($data->pdf)): ?>
                    <iframe src="<?php echo e(App\Helpers\Helper::getImageUrl($data->pdf, 'servicenotifications')); ?>"
                        style="width: 100%;height:500px" frameborder="0"></iframe>
                <?php endif; ?>
                <a href="<?php echo e(route('services.show', $data->service_id)); ?>" class="btn btn-info"><i class="fa fa-home"></i><?php echo app('translator')->get('additional.pages.services.services'); ?></a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/servicenotifications/show.blade.php ENDPATH**/ ?>