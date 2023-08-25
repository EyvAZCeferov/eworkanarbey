<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('additional.pages.welcome.payments'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"><?php echo app('translator')->get('additional.pages.welcome.payments'); ?>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <?php if(auth()->user()->hasRole('admin')): ?>
                                        <th scope="col"><?php echo app('translator')->get('additional.forms.username'); ?></th>
                                    <?php endif; ?>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.amount'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.payment_time'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.payment_end_time'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(auth()->user()->hasRole('admin')): ?>
                                            <td><a href="<?php echo e(route('users.edit',$dat->user_id)); ?>">#<?php echo e($dat->user->fin_code); ?> <?php echo e($dat->user->name_surname); ?></a></td>
                                        <?php endif; ?>
                                        <td><?php echo e($dat->amount); ?>₼</td>
                                        <td
                                            <?php if($dat->payment_status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                            <?php echo app('translator')->get('additional.pages.payments.status_' . intval($dat->payment_status)); ?>
                                        </td>

                                        <td><?php echo e($dat->created_at); ?></td>
                                        <td><?php echo e($dat->end_time); ?></td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/payments/index.blade.php ENDPATH**/ ?>