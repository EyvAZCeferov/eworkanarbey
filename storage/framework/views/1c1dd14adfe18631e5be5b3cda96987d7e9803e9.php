<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('additional.pages.users.admins'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"><?php echo app('translator')->get('additional.pages.users.admins'); ?>&nbsp; <a href="<?php echo e(route('admins.create')); ?>"
                            class="btn btn-success"><i class="fa fa-plus"></i></a>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.profile_picture'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.fincode'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.username'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = users()->where('is_admin',true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if(isset($dat->image) && !empty($dat->image)): ?>
                                                <img src="<?php echo e(App\Helpers\Helper::getImageUrl($dat->profile_picture, 'useradditionals')); ?>"
                                                    alt="<?php echo e($dat->name_surname); ?>" class="img-fluid img-responsive"
                                                    width="50">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($dat->fin_code); ?></td>
                                        <td><?php echo e($dat->name_surname); ?></td>
                                        <td
                                            <?php if($dat->status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                            <?php echo app('translator')->get('additional.pages.login.status_' . intval($dat->status)); ?>
                                        </td>

                                        <td><?php echo $__env->make('layouts.partials.table_buttons', [
                                            'edit' => true,
                                            'view' => false,
                                            'url' => 'admins',
                                            'delete' => true,
                                            'id' => $dat->id,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/admins/index.blade.php ENDPATH**/ ?>