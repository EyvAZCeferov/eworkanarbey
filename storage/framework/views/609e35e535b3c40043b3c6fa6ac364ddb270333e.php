<?php $__env->startSection('title'); ?>
    <?php if(isset($data) && !empty($data)): ?>
        <?php echo e($data->name_surname); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
    <?php else: ?>
        <?php echo app('translator')->get('additional.pages.users.users'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        function deletedevice(id) {
            event.preventDefault();
            var posting = $.ajax({
                url: '<?php echo e(route('auth.deletedevice')); ?>',
                dataType: 'json',
                data: {
                    device_id: id,
                },
                type: 'delete',
                success: function(data) {
                    showalertmessage(data.message, data.status);
                },
                error: function(data) {
                    showalertmessage(data.message, data.status);
                }
            });
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">
                        <?php if(isset($data) && !empty($data)): ?>
                            <?php echo e($data->name_surname); ?> <?php echo app('translator')->get('additional.pages.services.edit'); ?>
                        <?php else: ?>
                            <?php echo app('translator')->get('additional.pages.users.users'); ?> <?php echo app('translator')->get('additional.pages.services.add'); ?>
                        <?php endif; ?> &nbsp;
                        <a href="<?php echo e(route('admins.index')); ?>" class="btn btn-info"><i class="fa fa-home"></i></a>
                    </h6>
                    <div class="row">
                        <form
                            <?php if(isset($data) && !empty($data)): ?> action="<?php echo e(route('admins.update', $data->id)); ?>" <?php else: ?> action="<?php echo e(route('admins.store')); ?>" <?php endif; ?>
                            method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php if(isset($data) && !empty($data)): ?>
                                <?php echo method_field('PATCH'); ?>
                            <?php endif; ?>
                            <div class="row">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">Şəxsi məlumatlar</button>
                                        <?php if(isset($data) && !empty($data)): ?>
                                            <button class="nav-link" id="nav-devices-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-devices" type="button" role="tab"
                                                aria-controls="nav-devices" aria-selected="false">Cihazlar</button>
                                        <?php endif; ?>
                                    </div>
                                </nav>
                                <div class="tab-content pt-3" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label for="exampleInputAZNAME"
                                                        class="form-label"><?php echo app('translator')->get('additional.forms.username'); ?></label>
                                                    <input type="text" class="form-control" id="exampleInputAZNAME"
                                                        name="name_surname"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->name_surname) && !empty(trim($data->name_surname)) ? $data->name_surname : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.fincode'); ?></label>
                                                    <input type="text" class="form-control" name="fin_code"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->fin_code) && !empty(trim($data->fin_code)) ? $data->fin_code : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.email'); ?></label>
                                                    <input type="text" class="form-control" name="email"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->email) && !empty(trim($data->email)) ? $data->email : null); ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.phone'); ?></label>
                                                    <input type="text" class="form-control" name="phone"
                                                        value="<?php echo e(isset($data) && !empty($data) && isset($data->phone) && !empty(trim($data->phone)) ? $data->phone : null); ?>">
                                                    <span class="w-100 text-center text-muted">0501112233</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.status'); ?></label>
                                                    <select name="status" class="form-control">
                                                        <option value="1"
                                                            <?php if(isset($data) && !empty($data) && $data->status == 1): ?> selected <?php endif; ?>>
                                                            <?php echo app('translator')->get('additional.pages.login.status_1'); ?></option>
                                                        <option value="0"
                                                            <?php if(isset($data) && !empty($data) && $data->status == 0): ?> selected <?php endif; ?>>
                                                            <?php echo app('translator')->get('additional.pages.login.status_0'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label"><?php echo app('translator')->get('additional.forms.profile_picture'); ?></label>
                                                    <?php if(isset($data) && !empty($data) && isset($data->profile_picture) && !empty($data->profile_picture)): ?>
                                                        <img src="<?php echo e(App\Helpers\Helper::getImageUrl($data->profile_picture, 'useradditionals')); ?>"
                                                            alt="<?php echo e($data->name_surname ?? null); ?>"
                                                            class="img-fluid img-responsive">
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control" name="profile_picture">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <?php if(isset($data) && !empty($data)): ?>
                                                        <label class="form-label"><?php echo app('translator')->get('additional.forms.newpassword'); ?></label>
                                                        <input type="password" class="form-control" name="new_password">
                                                    <?php else: ?>
                                                        <label class="form-label"><?php echo app('translator')->get('additional.forms.password'); ?></label>
                                                        <input type="password" class="form-control" name="password"
                                                            value="<?php echo e(isset($data) && !empty($data) && isset($data->password) && !empty(trim($data->password)) ? $data->password : null); ?>">
                                                    <?php endif; ?>


                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>

                                                    <select name="role" class="form-control">

                                                        <?php $__currentLoopData = \Spatie\Permission\Models\Role::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if(isset($data) && !empty($data) && $data->hasRole($role->name)): ?> selected <?php endif; ?> value="<?php echo e($role->name); ?>"><?php echo e($role->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(isset($data) && !empty($data)): ?>
                                        <div class="tab-pane fade" id="nav-devices" role="tabpanel"
                                            aria-labelledby="nav-devices-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover" id="example">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">IpAddress</th>
                                                            <th scope="col">Device</th>
                                                            <th scope="col">Adres</th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.status'); ?></th>
                                                            <th scope="col"><?php echo app('translator')->get('additional.forms.buttons'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__currentLoopData = $data->devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo e($dat->ipaddress); ?>

                                                                </td>
                                                                <td>
                                                                    <?php if(!empty($dat->device_data)): ?>
                                                                        Device: <?php echo e($dat->device_data['device']); ?> --OS:
                                                                        <?php echo e($dat->device_data['platform']); ?> --Browser
                                                                        <?php echo e($dat->device_data['browser']); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if(!empty($dat->address_data)): ?>
                                                                        City:<?php echo e($dat->address_data['geoplugin_city']); ?>

                                                                    <?php endif; ?>
                                                                </td>
                                                                <td
                                                                    <?php if($dat->status == true): ?> class="text-success" <?php else: ?> class="text-danger" <?php endif; ?>>
                                                                    <?php echo app('translator')->get('additional.pages.login.status_' . intval($dat->status)); ?>
                                                                </td>

                                                                <td>
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-block"
                                                                        onclick="deletedevice('<?php echo e($dat->id); ?>')"><i
                                                                            class="fa fa-trash"></i></button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row my-2">
                                <button class="btn btn-primary btn-block"><?php echo app('translator')->get('additional.buttons.confirmation'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/GlobalMartDev/AnarBey/adminstration_panel/resources/views/admins/create_edit.blade.php ENDPATH**/ ?>