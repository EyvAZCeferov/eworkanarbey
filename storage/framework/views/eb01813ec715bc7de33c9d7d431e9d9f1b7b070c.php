<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('additional.pages.users.users'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"><?php echo app('translator')->get('additional.pages.users.users'); ?>&nbsp; <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success"><i
                                class="fa fa-plus"></i></a>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.profile_picture'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.fincode'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.username'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.pages.login.company_information'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = users()->where('is_admin',false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <?php if(isset($dat->additionalinfo->company_logo) && !empty($dat->additionalinfo->company_logo)): ?>
                                                <img src="<?php echo e(App\Helpers\Helper::getImageUrl($dat->additionalinfo->company_logo, 'useradditionals')); ?>"
                                                    alt="<?php echo e($dat->name_surname); ?>" class="img-fluid img-responsive"
                                                    width="50">
                                            <?php elseif(isset($dat->profile_picture) && !empty($dat->profile_picture)): ?>
                                                <img src="<?php echo e(App\Helpers\Helper::getImageUrl($dat->profile_picture, 'useradditionals')); ?>"
                                                    alt="<?php echo e($dat->name_surname); ?>" class="img-fluid img-responsive"
                                                    width="50">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($dat->fin_code); ?></td>
                                        <td><?php echo e($dat->name_surname); ?></td>
                                        <td><?php echo e(!empty($dat->additionalinfo) && isset($dat->additionalinfo->company_name)
                                            ? $dat->additionalinfo->company_name
                                            : trans('additional.pages.login.notacompany')); ?>

                                        </td>
                                        <td
                                            <?php if($dat->status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                            <?php echo app('translator')->get('additional.pages.login.status_' . intval($dat->status)); ?>
                                        </td>

                                        <td><?php echo $__env->make('layouts.partials.table_buttons', [
                                            'edit' => auth()->check() && auth()->user()->hasRole('admin') ? true :false,
                                            'view' => true,
                                            'url' => 'users',
                                            'delete' => auth()->check() && auth()->user()->hasRole('admin') ? true :false,
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/users/index.blade.php ENDPATH**/ ?>