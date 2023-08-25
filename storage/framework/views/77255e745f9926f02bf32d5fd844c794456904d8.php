<?php $__env->startSection('title'); ?>
    <?php echo e($service->name[app()->getLocale() . '_name']); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('description'); ?>
    <?php if(isset($service->description[app()->getLocale() . '_description'])): ?>
        <?php echo e($service->description[app()->getLocale() . '_description']); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <?php if(auth()->check() && auth()->user()->is_admin == false && count($data) == 0): ?>
            <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
                <div class="col-md-6 text-center">
                    <h3><?php echo e($service->name[app()->getLocale() . '_name']); ?></h3>
                    <h3><?php echo app('translator')->get('additional.pages.services.notinformation'); ?></h3>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-secondary rounded h-100 p-4">
                        <h6 class="mb-4"><?php echo e($service->name[app()->getLocale() . '_name']); ?> <?php if(auth()->user()->hasRole('admin') ||
                                auth()->user()->hasRole('moderator')): ?>
                                &nbsp;<a class="btn btn-success"
                                    href="<?php echo e(route('servicenotifications.create', ['slug' => $service->slugs[app()->getLocale() . '_slug']])); ?>"><i
                                        class="fa fa-plus"></i></a>
                            <?php endif; ?>
                        </h6>
                        <?php if(isset($service->description) &&
                                !empty($service->description) &&
                                isset($service->description[app()->getLocale() . '_description']) &&
                                !empty($service->description[app()->getLocale() . '_description'])): ?>
                            <p><?php echo e($service->description[app()->getLocale() . '_description']); ?></p>
                            <br>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table text-start align-middle table-bordered table-hover mb-0" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                        <?php $__currentLoopData = $tableheaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($header['name'] ?? null); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(auth()->check() && auth()->user()->is_admin == true): ?>
                                            <th><?php echo app('translator')->get('additional.forms.user'); ?></th>
                                        <?php endif; ?>
                                        <th><?php echo app('translator')->get('additional.forms.time'); ?></th>

                                        <th><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <?php $__currentLoopData = $tableheaders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <td>
                                                    <?php if($header['variable'] == 'name'): ?>
                                                        <?php if($header['type'] == 'data'): ?>
                                                            <?php echo e($dat->name[app()->getLocale() . '_name']); ?>

                                                        <?php else: ?>
                                                            <?php echo e(servicenotificationattribute($header['model']->attribute_group_id,$dat->id)->attribute->name[app()->getLocale().'_name'] ?? null); ?>

                                                        <?php endif; ?>
                                                    <?php elseif($header['variable'] == 'description'): ?>
                                                        <?php if($header['type'] == 'data'): ?>
                                                            <?php echo e(mb_substr($dat->description[app()->getLocale() . '_description'], 0, 200)); ?>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            <?php if(auth()->check() && auth()->user()->is_admin == true): ?>
                                                <td>
                                                    #<?php echo e($dat->user->fin_code); ?> --
                                                    <?php echo e(isset($dat->user->additionalinfo->company_name) && !empty($dat->user->additionalinfo->comapny_name) ? '(' . $dat->user->additional_info->company_name . ')' : $dat->user->name_surname); ?>

                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <?php echo e(App\Helpers\Helper::getDateTimeViaTimeStamp($dat->time, false, 'a')); ?>

                                            </td>
                                            <td><?php echo $__env->make('layouts.partials.table_buttons', [
                                                'edit' =>
                                                    (auth()->check() &&
                                                        auth()->user()->hasRole('admin')) ||
                                                    (auth()->check() &&
                                                        auth()->user()->hasRole('moderator'))
                                                        ? true
                                                        : false,
                                                'view' => true,
                                                'url' => 'servicenotifications',
                                                'delete' =>
                                                    auth()->check() &&
                                                    auth()->user()->hasRole('admin')
                                                        ? true
                                                        : false,
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
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/services/show.blade.php ENDPATH**/ ?>