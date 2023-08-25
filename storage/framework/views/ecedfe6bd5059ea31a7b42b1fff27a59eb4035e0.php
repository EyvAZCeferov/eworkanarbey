<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('additional.urls.standartpages'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"><?php echo app('translator')->get('additional.urls.standartpages'); ?>&nbsp; <a href="<?php echo e(route('standartpages.create')); ?>"
                        class="btn btn-success"><i class="fa fa-plus"></i></a>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover" id="example">
                            <thead>
                                <tr>

                                    <th scope="col"><?php echo app('translator')->get('additional.forms.title'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.content'); ?></th>
                                    <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = standartpages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($dat->name[app()->getLocale().'_name']); ?></td>
                                        <td>
                                            <?php echo e(mb_substr(App\Helpers\Helper::strip_tags_with_whitespace($dat->description[app()->getLocale().'_description']),0,300)); ?>

                                        </td>

                                        <td scope="col"><?php echo $__env->make('layouts.partials.table_buttons', [
                                            'edit' => auth()->check() && auth()->user()->hasRole('admin') ? true : false,
                                            'view' => true,
                                            'url' => 'standartpages',
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/standartpages/index.blade.php ENDPATH**/ ?>